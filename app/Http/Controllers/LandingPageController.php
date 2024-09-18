<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Company;
use App\Models\People;
use GuzzleHttp\Psr7\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil 10 data investor dari database
        $investors = Investor::take(10)->get();

        // Ambil 10 data company dari database
        $companies = Company::getFilteredCompanies();

        // Ambil 10 data people dari database
        $people = People::take(5)->get();

        // Kirim data investor, company, dan people ke view landingpage
        return view('landingpage', compact('investors', 'companies', 'people'));
    }
}
