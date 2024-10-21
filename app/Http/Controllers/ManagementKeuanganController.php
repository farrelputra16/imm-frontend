<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyOutcome;
use Illuminate\Support\Facades\Auth;

class ManagementKeuanganController extends Controller
{
    public function show(Request $request)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Ambil perusahaan terkait dengan user
        $company = $user->companies()->first(); // Ambil satu perusahaan pertama, sesuaikan jika perlu

        // Pastikan perusahaan ada
        if (!$company) {
            return redirect()->back()->with('error', 'Perusahaan tidak ditemukan.');
        }

        // Ambil pendapatan perusahaan dengan pagination
        $companyIncomeController = app(CompanyIncomeController::class);
        $companyIncomes = $companyIncomeController->index($request); // Kirimkan request agar pagination berfungsi

        // Tambahkan label investasi ke setiap income
        foreach ($companyIncomes as $income) {
            $income->investment_type_label = $income->investment_type_label; // Menggunakan accessor
        }

        // Ambil proyek yang terkait dengan perusahaan dengan pagination
        $projects = app(ProjectController::class)->showProject($company->id, $request);

        // Kembalikan view dengan data yang diperlukan
        return view('homepageimm.kelolapengeluaran', compact('companyIncomes', 'projects'));
    }

    public function createOutcome(Request $request)
    {
        $project = app(CompanyOutcomeController::class)->create($request->project_id);
        return view('homepageimm.pengeluaran-proyek', compact('project'));
    }
}
