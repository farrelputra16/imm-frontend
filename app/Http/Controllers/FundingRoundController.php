<?php

namespace App\Http\Controllers;

use App\Models\FundingRound;
use App\Models\Company;
use App\Models\Investor;
use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundingRoundController extends Controller
{
    /**
     * Menampilkan daftar semua funding round (tanpa perlu company_id dari user yang login).
     */
    public function index(Request $request)
{
    // Ambil query untuk filtering berdasarkan input dari request
    $query = FundingRound::query()->with('company');
    $rowsPerPage = $request->input('rows', 10);

    // Filter berdasarkan perusahaan (company)
    if ($request->filled('company_id')) {
        $query->where('company_id', $request->company_id);
    }

    // Filter berdasarkan funding type (funding_stage pada tabel companies)
    if ($request->filled('funding_type')) {
        $query->whereHas('company', function ($q) use ($request) {
            $q->where('funding_stage', $request->funding_type);
        });
    }

    // Filter untuk funding rounds yang diumumkan dalam 30 hari terakhir
    if ($request->filled('announced_last_30_days')) {
        $query->where('announced_date', '>=', now()->subDays(30));
    }

    // Dapatkan hasil filtering
    $fundingRounds = $query->paginate($rowsPerPage);


    // Ambil semua companies untuk dropdown filtering
    $companies = Company::all();

    // Render view dengan data yang difilter
    return view('funding_rounds.index', compact('fundingRounds', 'companies'));
}


public function companyList()
{
    // Ambil user yang login
    $user = Auth::user();

    // Ambil perusahaan yang dimiliki oleh user yang login
    $company = Company::where('user_id', $user->id)->first();

    // Ambil semua funding rounds yang dimiliki oleh perusahaan
    if ($company) {
        $fundingRounds = FundingRound::where('company_id', $company->id)->get();
    } else {
        return redirect()->route('profile-company')->with('error', 'Anda belum mendaftarkan perusahaan.');
    }

    // Tampilkan view list funding round
    return view('funding_rounds.company.list', compact('fundingRounds', 'company'));
}

public function companyDetail(FundingRound $fundingRound)
{
    // Pastikan funding round milik perusahaan yang login
    $user = Auth::user();
    $company = Company::where('user_id', $user->id)->first();

    if (!$company || $fundingRound->company_id != $company->id) {
        return redirect()->route('company.funding_rounds.list')->with('error', 'Anda tidak memiliki akses ke funding round ini.');
    }

    // Ambil semua investor yang telah berinvestasi dalam funding round ini
    $investors = $fundingRound->investments()->with('investor')->get()->map(function ($investment) {
        return $investment->investor;
    });

    // Tampilkan halaman detail funding round dengan opsi memilih lead investor
    return view('funding_rounds.company.detail', compact('fundingRound', 'investors', 'company'));
}



public function companyUpdate(Request $request, FundingRound $fundingRound)
{

    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'target' => 'nullable|numeric',
        'announced_date' => 'nullable|date',
        'lead_investor_id' => 'nullable|exists:investors,id',
    ]);

    // Update data funding round
    $fundingRound->update([
        'name' => $validated['name'],
        'target' => $validated['target'],
        'announced_date' => $validated['announced_date'],
        'lead_investor_id' => $validated['lead_investor_id'],
    ]);

    return redirect()->route('company.funding_rounds.list', $fundingRound->id)->with('success', 'Funding Round updated successfully!');
}
public function companyCreate()
{
    // Ambil user yang login
    $user = Auth::user();

    // Cek apakah user memiliki perusahaan
    $company = Company::where('user_id', $user->id)->first();

    if (!$company) {
        // Jika tidak ada perusahaan, redirect ke halaman profil perusahaan dengan pesan error
        return redirect()->route('profile-company')->with('error', 'Anda belum mendaftarkan perusahaan.');
    }

    return view('funding_rounds.company.create', compact('company'));
}

public function companyStore(Request $request)
{
    // Validasi input, tambahkan validation untuk funding_stage dan description
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'target' => 'nullable|numeric',
        'announced_date' => 'nullable|date',
        'funding_stage' => 'nullable|string|max:255',  // Validation untuk funding_stage
        'description' => 'nullable|string',  // Validation untuk description
    ]);

    // Ambil user yang login
    $user = Auth::user();

    // Dapatkan perusahaan yang terhubung dengan user
    $company = Company::where('user_id', $user->id)->first();

    // Cek apakah perusahaan tersedia
    if (!$company) {
        return redirect()->route('profile-company')->with('error', 'Anda belum mendaftarkan perusahaan.');
    }

    // Membuat funding round baru
    FundingRound::create([
        'company_id' => $company->id,
        'name' => $validated['name'],
        'target' => $validated['target'],
        'announced_date' => $validated['announced_date'],
        'funding_stage' => $validated['funding_stage'],  // Menyimpan funding_stage
        'description' => $validated['description'],  // Menyimpan description
    ]);

    return redirect()->route('company.funding_rounds.list')->with('success', 'Funding Round berhasil dibuat!');
}


// app/Http/Controllers/FundingRoundController.php

// app/Http/Controllers/FundingRoundController.php

public function startInvest($companyId)
{
    // Check if the logged-in user has the role 'INVESTOR'
    $user = Auth::user();

    if ($user->role !== 'INVESTOR') {
        // Redirect to the home page or show an unauthorized error if not an INVESTOR
        return redirect()->route('errors.403')->with('error', 'You do not have access to this page.');
    }

    // Find the company being viewed using the company ID from the URL
    $company = Company::find($companyId);

    // If the company is not found, redirect back with an error
    if (!$company) {
        return redirect()->route('companies.list')->with('error', 'Company not found.');
    }

    // Get funding rounds that belong to this company
    $fundingRounds = FundingRound::with('company', 'leadInvestor')
        ->where('company_id', $company->id)
        ->get();

    // Pass the funding rounds and company to the view
    return view('funding_rounds.start_invest', compact('fundingRounds', 'company'));
}


public function show(FundingRound $fundingRound)
{
    // Get all the investments for this funding round with investor details
    $investments = Investment::with('investor')
        ->where('funding_round_id', $fundingRound->id)
        ->get();

    // Pass the funding round and its investments to the view
    return view('funding_rounds.show', compact('fundingRound', 'investments'));
}

}
