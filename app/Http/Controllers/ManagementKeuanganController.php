<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyOutcome;
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

        $projectsWithFunding = $projects->map(function ($project) use ($companyIncomes) {
            $externalFunding = collect();
            $internalFunding = collect();

            foreach ($project->dana as $dana) {
                if (in_array($dana->jenis_dana, ['Hibah', 'Investasi', 'Pinjaman', 'Pre-seed Funding', 'Seed Funding', 'Series A Funding', 'Series B Funding', 'Series C Funding', 'Series D Funding', 'Series E Funding', 'Debt Funding', 'Equity Funding', 'Convertible Debt', 'Grants', 'Revenue-Based Financing', 'Private Equity', 'IPO'])) {
                    $externalFunding->push($dana);
                } else {
                    $internalFunding->push($dana);
                }
            }

            $project->externalFunding = $externalFunding;
            $project->internalFunding = $internalFunding;

            // Hitung total dana masuk untuk proyek ini
            $totalIncome = $companyIncomes->where('project_id', $project->id)->sum('jumlah');

            // Hitung total pengeluaran untuk proyek ini
            $totalOutcome = CompanyOutcome::where('project_id', $project->id)->sum('jumlah_biaya');

            // Hitung total dana yang tersedia
            $project->totalDanaTersedia = $totalIncome + $externalFunding->sum('nominal') + $internalFunding->sum('nominal') - $totalOutcome;

            return $project;
        });

        return view('homepageimm.kelolapengeluaran', compact('companyIncomes', 'projectsWithFunding'));
    }

    public function createOutcome(Request $request)
    {
        $project = app(CompanyOutcomeController::class)->create($request->project_id);
        return view('homepageimm.pengeluaran-proyek', compact('project'));
    }
}
