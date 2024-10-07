<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementKeuanganController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $company = $user->companies; // Mengambil company terkait dengan user
        $companyIncomeController = app(CompanyIncomeController::class);
        $companyOutcomeController = app(CompanyOutcomeController::class);

        $companyIncomes = $companyIncomeController->index();
        $projects = app(ProjectController::class)->showProjectWithDanas($company->id);
        return view('homepageimm.kelolapengeluaran', compact('companyIncomes', 'projects'));
    }
}
