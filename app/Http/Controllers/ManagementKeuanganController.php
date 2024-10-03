<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementKeuanganController extends Controller
{
    public function show(Request $request)
    {
        $companyIncomeController = app(CompanyIncomeController::class);
        $companyOutcomeController = app(CompanyOutcomeController::class);

        $companyIncomes = $companyIncomeController->index();
        $projects = $companyOutcomeController->index($request);
        return view('homepageimm.kelolapengeluaran', compact('companyIncomes', 'projects'));
    }
}
