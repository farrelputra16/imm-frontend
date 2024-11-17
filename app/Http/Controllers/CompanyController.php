<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Project;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class CompanyController extends Controller
{
    /**
     * Update the specified Company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan melalui formulir
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'profile' => 'required|string|max:255',
            'founded_date' => 'required|date',
            'tipe' => 'required|string|max:255',
            'nama_pic' => 'required|string|max:255',
            'posisi_pic' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'jumlah_karyawan' => 'required|integer',
            'startup_summary' => 'required|string', // Update this rule
        ]);

        // Temukan Company berdasarkan ID
        $company = Company::findOrFail($id);

        // Update data perusahaan
        $company->update($validated);

        // Redirect ke halaman profil perusahaan dengan pesan sukses
        return redirect()->route('profile-company.show', $company->id)->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan melalui formulir
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'profile' => 'required|string|max:255',
            'founded_date' => 'required|date',
            'business_model' => 'required|string|max:255', // Pastikan ini ada dan benar
            'nama_pic' => 'required|string|max:255',
            'posisi_pic' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'jumlah_karyawan' => 'required|integer',
            'startup_summary' => 'required|string',
            'tag_ids' => 'array',
            'funding_stage' => 'required|string|max:255',
        ]);


        // Simpan data ke dalam database
        $company = Company::create([
            'user_id' => Auth::id(),
            'nama' => $validated['nama'],
            'profile' => $validated['profile'],
            'founded_date' => $validated['founded_date'],
            'business_model' => $validated['business_model'], // Pastikan ini ada dan benar
            'nama_pic' => $validated['nama_pic'],
            'posisi_pic' => $validated['posisi_pic'],
            'telepon' => $validated['telepon'],
            'negara' => $validated['negara'],
            'provinsi' => $validated['provinsi'],
            'kabupaten' => $validated['kabupaten'],
            'jumlah_karyawan' => $validated['jumlah_karyawan'],
            'startup_summary' => $validated['startup_summary'],
            'funding_stage' => $validated['funding_stage'],
        ]);

        // Attach departments to the company
        if (isset($validated['tag_ids'])) {
            $company->departments()->attach($validated['tag_ids']);
        }

        // Redirect ke homepage
        return redirect()->route('homepage')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified Company.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        // Ambil parameter untuk funding rounds
        $fundingRowsPerPage = $request->get('funding_rows', 10); // Default 10
        $fundingRounds = $company->fundingRounds()->paginate($fundingRowsPerPage);

        // Ambil parameter untuk project list
        $projectRowsPerPage = $request->get('project_rows', 10); // Default 10
        $allProjectsQuery = Project::with('tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan', 'dana')
            ->whereHas('company', fn($query) => $query->where('id', $id))
            ->paginate($projectRowsPerPage);

        // Load team members and assign departments
        $team = $company->teamMembers;
        foreach ($team as $person) {
            $position_id = $person->pivot->position;
            $department = Department::find($position_id);
            $person->department = $department ? $department->name : 'No department assigned';
        }

        return view('companies.view', compact('company', 'fundingRounds', 'team', 'allProjectsQuery'));
    }

    public function showBenchmark(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        // Ambil parameter untuk funding rounds
        $fundingRowsPerPage = $request->get('funding_rows', 10); // Default 10
        $fundingRounds = $company->fundingRounds()->paginate($fundingRowsPerPage);

        // Ambil parameter untuk project list
        $projectRowsPerPage = $request->get('project_rows', 10); // Default 10
        $allProjectsQuery = Project::with('tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan', 'dana')
            ->whereHas('company', fn($query) => $query->where('id', $id))
            ->paginate($projectRowsPerPage);

        $total_funding = $company->fundingRounds->sum('money_raised');
        $total_round = $company->fundingRounds->count();
        $funding_terbaru = $company->fundingRounds->sortByDesc('announced_date')->first();
        $total_investor = $company->investments->count();

        // Step 1: Aggregate data for the investment chart
        $investments = $company->investments()
        ->selectRaw('investment_date, SUM(amount) as total_amount')
        ->groupBy('investment_date')
        ->orderBy('investment_date')
        ->get();

        // Format dates to "Mar 2024" format for investment chart
        $investmentLabels = $investments->pluck('investment_date')->map(function ($date) {
        return Carbon::parse($date)->format('M Y'); // e.g., Mar 2024
        });
        $investmentData = $investments->pluck('total_amount');

        // Chart setup for Investment Amount Over Time
        $chart_investment = new Chart();
        $chart_investment->dataset('Investment Amount', 'line', $investmentData)
        ->backgroundColor('rgba(154, 208, 245, 0.2)') // Set background color to lighter shade of #9AD0F5
        ->color('#9AD0F5'); // Line color to #9AD0F5
        $chart_investment->labels($investmentLabels);
        $chart_investment->displayLegend(false); // Hide legend

        // Step 2: Aggregate data for Laba Bersih by Quarter and Year
        $companyFinance = $company->companyFinance()
        ->selectRaw('tahun, status_quarter, SUM(laba_bersih_tahun_berjalan) as total_laba_bersih')
        ->groupBy('tahun', 'status_quarter')
        ->orderBy('tahun', 'asc')
        ->orderBy('status_quarter', 'asc')
        ->get();

        // Format labels as "Q1 2024" for laba bersih chart
        $labaBersihLabels = $companyFinance->map(function ($finance) {
        return $finance->status_quarter . ' ' . $finance->tahun; // e.g., Q1 2024
        });
        $labaBersihData = $companyFinance->pluck('total_laba_bersih');

        // Chart setup for Laba Bersih by Quarter
        $chart_laba_bersih = new Chart();
        $chart_laba_bersih->dataset('Net Profit', 'line', $labaBersihData)
        ->backgroundColor('rgba(255, 98, 133, 0.2)') // Set background color to lighter shade of #FF6285
        ->color('#FF6285'); // Line color to #FF6285
        $chart_laba_bersih->labels($labaBersihLabels);
        $chart_laba_bersih->displayLegend(false); // Hide legend

        return view('companies.benchmark', compact('company', 'fundingRounds', 'allProjectsQuery', 'total_funding', 'total_round', 'funding_terbaru', 'total_investor', 'chart_investment', 'chart_laba_bersih'));
    }


    public function index()
    {
        $user = Auth::user();
        $companies = Company::where('user_id', $user->id)->get();
        return view('homepageimm.homepage', compact('companies'));
    }
    /**
     * Show the form for editing the specified Company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Remove the specified Company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    // Pada bagian di bawah ini merupkan kode untuk menampilkan data company list yang sudah pernah dibuat oleh seluruh user ditambah dengan beberapa data dari luar yaitu danas
    public function companyList(Request $request)
    {
        $rowsPerPage = $request->input('rows', 10);
        $companies = Company::getFilteredCompaniesPaginated($request, $rowsPerPage);

        // Append semua parameter yang digunakan untuk filter
        $companies->appends($request->only([
            'location',
            'departments',
            'business_model',
            'funding_stage',
            'search',
        ]));

        $department = Department::all();
        if ($request->has('status'))
        {
            $status = $request->input('status');
        }
        return view('companies.company-list', compact('companies', 'request', 'department', 'status'));
    }

    /**
     * Menampilkan halaman untuk anggota team company tersebut
     */
    public function showTeam($id)
    {
        $company = Company::findOrFail($id);
        $team = $company->teamMembers;
        return view('companies.team', compact('team', 'company'));
    }

    /**
     * Menampilkan halaman untuk macam macam project yang dimiliki oleh company tersebut
     */
    public function showProducts($id)
    {
        $company = Company::findOrFail($id);
        $company->load('projects');
        // Memisahkan projects berdasarkan status (Ongoing and Completed)
        $ongoingProjects = $company->projects->where('status', 'Belum selesai');
        $completedProjects = $company->projects->where('status', 'Selesai');
        return view('companies.project', compact('company', 'ongoingProjects', 'completedProjects'));
    }

    public function create_company()
    {
        // Mengambil data departments untuk digunakan pada view
        $departments = Department::all();

        // Mengirim data departments ke view 'imm.pendaftaranperusahaan'
        return view('imm.pendaftaranperusahaan', compact('departments'));
    }
}
