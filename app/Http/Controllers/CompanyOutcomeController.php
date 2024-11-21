<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Project;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Models\CompanyOutcome;
use Illuminate\Routing\Controller;
use App\Mail\ProjectOutcomeUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyOutcomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $company = $user->companies; // Mengambil company terkait dengan user

        if (!$company) {
            // Handle jika user tidak terhubung dengan company
            return redirect()->back()->with('error', 'User tidak terhubung dengan company.');
        }

        $companyId = $company->id;

        $projects = Project::where('company_id', $companyId);

        if ($request->has('search')) {
            $search = $request->input('search');
            $projects->where('nama', 'like', '%' . $search . '%');
        }
        $projects = $projects->get();
        return $projects;
    }

    public function detailOutcome(Request $request, $project_id)
    {
        $status = null;
        if ($request->has('status')) {
            $status = $request->status;
        }
        $rowsPerPage = request('rows') ?? 10;

        // Make sure you are always paginating, even if outcomes are empty
        $outcomes = CompanyOutcome::where('project_id', $project_id)->paginate($rowsPerPage);

        $project = Project::findOrFail($project_id);
        $user = auth()->user();
        $isCompany = $user->role === 'USER';
        if ($isCompany) {
            $company = $user->companies()->first();
        } else {
            $company = $project->company;
        }
        $companyName = strtolower(str_replace(' ', '_', $company->nama));
        $companyId = $company->id;

        return view('homepageimm.detailbiaya', compact('outcomes', 'project_id', 'project', 'isCompany', 'companyName', 'companyId', 'status'));
    }

    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);
        return $project;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'jumlah_biaya' => 'required|numeric',
            'bukti' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:10000',
            'pelaporan_dana' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        $buktiFileName = null;

        if ($request->hasFile('bukti')) {
            $buktiFile = $request->file('bukti');
            $buktiFileName = $buktiFile->getClientOriginalName(); // Mengambil nama asli file

            // Mengambil nama perusahaan untuk digunakan dalam path
            $company = Company::find($validatedData['company_id']);
            $folderName = strtolower(str_replace(' ', '_', $company->nama)); // Membuat nama folder dari nama perusahaan
            $path = $buktiFile->storeAs("public/{$folderName}/laporan_pengeluaran", $buktiFileName); // Menyimpan di folder sesuai nama perusahaan

            // Mengambil URL untuk disimpan
            $buktiUrl = Storage::url($path); // Mendapatkan URL dari file yang disimpan
        }

        $outcome = CompanyOutcome::create([
            'date' => $validatedData['date'],
            'jumlah_biaya' => $validatedData['jumlah_biaya'],
            'bukti' => $buktiUrl, // Menyimpan URL bukti
            'pelaporan_dana' => $validatedData['pelaporan_dana'],
            'project_id' => $validatedData['project_id'],
        ]);

        // Ambil semua investor yang berinvestasi di perusahaan ini
        $investments = Investment::where('company_id', $validatedData['company_id'])->get();

        foreach ($investments as $investment) {
            $investor = $investment->investor;
            $user = $investor->user;
            $email = $user->email;

            try {
                // Kirim email ke investor
                Mail::to($email)->send(new ProjectOutcomeUpdated($outcome));
            } catch (\Exception $e) {
                // Log error jika email gagal dikirim
                Log::error("Email gagal dikirim ke {$email}: " . $e->getMessage());
            }
        }

        return redirect()->route('homepageimm.detailbiaya', ['project_id' => $validatedData['project_id']])->with('success', 'Penggunaan dana berhasil ditambahkan.');
    }
}
