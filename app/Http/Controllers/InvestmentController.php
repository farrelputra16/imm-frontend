<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Investor;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Models\CompanyIncome;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    // Menampilkan form investasi untuk investor
    public function create(Company $company)
    {
        // Muat project beserta dana
        $company->load(['projects.dana']);
        $projects = $company->projects; // Ambil project yang terkait dengan company

        // Ambil nama depan pengguna yang sedang login
        $user = Auth::user();
        $firstName = $user->nama_depan . ' ' . $user->nama_belakang; // Menggunakan titik untuk menggabungkan string

        // Mapping projects untuk memisahkan external dan internal funding
        $projectsWithFunding = $projects->map(function ($project) {
            $externalFunding = collect();
            $internalFunding = collect();

            // Pisahkan funding berdasarkan jenisnya
            foreach ($project->dana as $dana) {
                if (in_array($dana->jenis_dana, [
                    'Hibah', 'Investasi', 'Pinjaman', 'Pre-seed Funding', 'Seed Funding', 
                    'Series A Funding', 'Series B Funding', 'Series C Funding', 'Series D Funding', 
                    'Series E Funding', 'Debt Funding', 'Equity Funding', 'Convertible Debt', 
                    'Grants', 'Revenue-Based Financing', 'Private Equity', 'IPO'])) {
                    $externalFunding->push($dana);
                } else {
                    $internalFunding->push($dana);
                }
            }

            // Tambahkan ke project
            $project->externalFunding = $externalFunding;
            $project->internalFunding = $internalFunding;

            return $project;
        });

        // Siapkan jenis investasi yang bisa dipilih
        $investmentTypes = ['venture_capital', 'angel_investment', 'crowdfunding', 'government_grant', 'foundation_grant', 'buyout', 'growth_capital'];

        // Kirim data ke view
        return view('investments.create', compact('company', 'projectsWithFunding', 'investmentTypes', 'firstName'));
    }

    // Menyimpan data investasi
    public function store(Request $request, Company $company)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'project_id' => 'required|exists:projects,id',
            'investment_date' => 'required|date',
            'pengirim' => 'required|string',
            'bank_asal' => 'required|string',
            'bank_tujuan' => 'required|string',
            'funding_type' => 'required|string',
            'tipe_investasi' => 'required|string',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();
        // Ambil investor dari user_id yang login
        $investor = Investor::where('user_id', $user->id)->first();

        if (!$investor) {
            return redirect()->back()->withErrors(['error' => 'You must be an investor to invest.']);
        }

        Investment ::create([
            'investor_id' => $investor->id,
            'company_id' => $company->id,
            'project_id' => $request->project_id,
            'amount' => $request->amount,
            'investment_date' => $request->investment_date,
            'status' => 'pending',
            'pengirim' => $request->pengirim,
            'bank_asal' => $request->bank_asal,
            'bank_tujuan' => $request->bank_tujuan,
            'funding_type' => $request->funding_type,
            'tipe_investasi' => $request->tipe_investasi,
        ]);

        return redirect()->route('investments.pending')->with('success', 'Investment submitted successfully!');
    }

    // Menampilkan daftar pending investment untuk investor
    public function pending()
    {
        $investor = Investor::where('user_id', Auth::id())->first();
    
        if (!$investor) {
            // Redirect back with an error message if the investor is not found
            return redirect()->back()->withErrors(['error' => 'Investor not found. Please ensure you have registered as an investor.']);
        }
    
        $investments = Investment::where('investor_id', $investor->id)->get();
        return view('investments.pending', compact('investments'));
    }

    // Menampilkan halaman approval untuk pemilik perusahaan
    public function approval()
    {
        // Ambil user yang login sebagai pemilik perusahaan
        $user = Auth::user();

        // Ambil semua investasi yang berkaitan dengan perusahaan yang dimiliki user (tidak hanya pending)
        $investments = Investment::whereHas('company', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get(); // Mengambil semua status (pending, approved, rejected)

        return view('investments.approvals', compact('investments'));
    }


    // Mengupdate status investasi (approve/reject)
    public function updateStatus(Request $request, Investment $investment)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Update status investasi
        $investment->update([
            'status' => $request->status,
        ]);

        // Jika status diupdate menjadi 'approved'
        if ($request->status == 'approved') {
            CompanyIncome::create([
                'company_id' => $investment->company_id,
                'project_id' => $investment->project_id,
                'date' => $investment->investment_date,
                'pengirim' => $investment->pengirim,
                'bank_asal' => $investment->bank_asal,
                'bank_tujuan' => $investment->bank_tujuan,
                'jumlah' => $investment->amount,
                'funding_type' => $investment->funding_type,
                'tipe_investasi' => $investment->tipe_investasi,
            ]);
        }

        return redirect()->route('investments.approvals')->with('success', 'Investment status updated successfully!');
    }


    // Menyetujui investasi oleh pemilik perusahaan
    public function approve(Investment $investment)
    {
        $investment->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Investment approved successfully.');
    }
}
