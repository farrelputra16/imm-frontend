<?php

namespace App\Http\Controllers;

use App\Models\FundingRound;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundingRoundController extends Controller
{
    /**
     * Menampilkan daftar semua funding round (tanpa perlu company_id dari user yang login).
     */
    public function index()
    {
        // Ambil semua funding rounds (tanpa filter company_id)
        $fundingRounds = FundingRound::all();

        return view('funding_rounds.index', compact('fundingRounds'));
    }

    /**
     * Menampilkan form untuk membuat funding round baru.
     */
    public function create()
    {
        // Ambil user yang login
        $user = Auth::user();

        // Cek apakah user memiliki perusahaan
        $company = Company::where('user_id', $user->id)->first();

        if (!$company) {
            // Jika tidak ada perusahaan, redirect ke halaman profil perusahaan dengan pesan error
            return redirect()->route('profile-company')->with('error', 'Anda belum mendaftarkan perusahaan.');
        }

        return view('funding_rounds.create', compact('company'));
    }

    /**
     * Menyimpan data funding round yang baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target' => 'nullable|numeric',
            'announced_date' => 'nullable|date',
            'money_raised' => 'nullable|numeric',
            'lead_investor' => 'nullable|string|max:255',
        ]);

        // Ambil user yang login
        $user = Auth::user();

        // Dapatkan perusahaan yang terhubung dengan user
        $company = Company::where('user_id', $user->id)->first();

        // Cek apakah perusahaan tersedia
        if (!$company) {
            // Redirect ke halaman profil perusahaan dengan pesan error
            return redirect()->route('profile-company')->with('error', 'Anda belum mendaftarkan perusahaan.');
        }

        // Membuat funding round baru
        FundingRound::create([
            'company_id' => $company->id,
            'name' => $validated['name'],
            'target' => $validated['target'],
            'announced_date' => $validated['announced_date'],
            'money_raised' => $validated['money_raised'],
            'lead_investor' => $validated['lead_investor'],
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('funding_rounds.index')->with('success', 'Funding Round berhasil dibuat!');
    }
    public function show(FundingRound $fundingRound)
    {
        return view('funding_rounds.show', compact('fundingRound'));
    }
}
