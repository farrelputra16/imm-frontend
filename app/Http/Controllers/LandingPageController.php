<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Company;
use GuzzleHttp\Psr7\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil 10 data investor dari database
        $investors = Investor::take(10)->get();

        // Ambil 10 data company dari database
        $companies = Company::getFilteredCompanies();

        // Kirim data investor dan company ke view landingpage
        return view('landingpage', compact('investors', 'companies'));
    }
}
