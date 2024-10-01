<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Company;
use App\Models\Project;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    // Menampilkan form investasi untuk investor
    public function create(Company $company)
    {
        $company->load('projects');
        $projects = $company->projects; // Ambil project yang terkait dengan company
        return view('investments.create', compact('company', 'projects'));
    }

    // Menyimpan data investasi
    public function store(Request $request, Company $company)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'project_id' => 'required|exists:projects,id',
            'investment_date' => 'required|date',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();
        // Ambil investor dari user_id yang login
        $investor = Investor::where('user_id', $user->id)->first();

        if (!$investor) {
            return redirect()->back()->withErrors(['error' => 'You must be an investor to invest.']);
        }

        Investment::create([
            'investor_id' => $investor->id,
            'company_id' => $company->id,
            'project_id' => $request->project_id,
            'amount' => $request->amount,
            'investment_date' => $request->investment_date,
            'status' => 'pending',
        ]);

        return redirect()->route('investments.pending')->with('success', 'Investment submitted successfully!');
    }

    // Menampilkan daftar pending investment untuk investor
    public function pending()
    {
        $investor = Investor::where('user_id', Auth::id())->first();
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

        $investment->update([
            'status' => $request->status,
        ]);

        return redirect()->route('investments.approvals')->with('success', 'Investment status updated successfully!');
    }

    // Menyetujui investasi oleh pemilik perusahaan
    public function approve(Investment $investment)
    {
        $investment->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Investment approved successfully.');
    }
}
