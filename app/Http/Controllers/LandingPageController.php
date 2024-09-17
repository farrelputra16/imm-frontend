<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Company;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil 10 data investor dari database
        $investors = Investor::take(10)->get();

        // Ambil 10 data company dari database
        $companies = Company::take(10)->get();

        // Kirim data investor dan company ke view landingpage
        return view('landingpage', compact('investors', 'companies'));
    }
}
