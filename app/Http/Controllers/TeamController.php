<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function showTeam($id)
    {
        // Ambil data company berdasarkan ID
        $company = Company::with('teamMembers')->findOrFail($id);
        
        // Ambil data team dari company (relasi many-to-many dengan people)
        $team = $company->teamMembers;
        
        // Return view dengan data team dan company
        return view('companies.team', compact('team', 'company'));
    }
}
