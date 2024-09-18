<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use App\Models\Tag;
use App\Models\Sdg;
use App\Models\Indicator;
use App\Models\Metric;
use App\Models\TargetPelanggan;
use App\Models\Dana;
use App\Models\CompanyIncome;
use App\Models\CompanyOutcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = $user->companies;
    
        $totalBalance = CompanyIncome::where('company_id', $company->id)->sum('jumlah');

        $totalOutcome = CompanyOutcome::whereHas('project', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })
            ->sum('jumlah_biaya');
    
        $sdgs = Sdg::all();
    
        $allProjects = Project::with('tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan', 'dana')
            ->whereHas('company', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();
    
        $ongoingProjects = $allProjects->where('status', 'Belum selesai');
        $completedProjects = $allProjects->where('status', 'Selesai');
    
        return view('homepageimm.homepage', compact('sdgs', 'allProjects', 'ongoingProjects', 'completedProjects', 'company', 'user', 'totalBalance', 'totalOutcome'));
    }    
}
