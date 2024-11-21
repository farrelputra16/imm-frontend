<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\CompanyOutcome;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CompanyIncomeController;
use App\Http\Controllers\CompanyOutcomeController;

class ManagementKeuanganController extends Controller
{
    public function show(Request $request, $company_id = null)
    {
        $status = null;
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        if ($request->has('status')) {
            $status = $request->status;
        }

        // Cek apakah role pengguna adalah "USER"
        $isUserRole = $user->role === 'USER';

        // Jika bukan user, ambil perusahaan berdasarkan company_id yang dikirimkan
        if (!$isUserRole) {
            $company = Company::find($company_id); // Ambil perusahaan berdasarkan ID
        } else {
            // Ambil perusahaan terkait dengan user
            $company = $user->companies()->first(); // Ambil satu perusahaan pertama, sesuaikan jika perlu
        }

        // Pastikan perusahaan ada
        if (!$company_id || !$company) {
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
        return view('homepageimm.kelolapengeluaran', compact('companyIncomes', 'projects', 'isUserRole', 'company', 'status'));
    }

    public function createOutcome(Request $request)
    {
        $project = app(CompanyOutcomeController::class)->create($request->project_id);
        if($request->has('company_id')){
            $company_id = $request->company_id;
        }
        return view('homepageimm.pengeluaran-proyek', compact('project', 'company_id'));
    }
}
