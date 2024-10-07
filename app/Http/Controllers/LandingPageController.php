<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Company;
use App\Models\People;
use App\Models\Hubs;
use App\Models\Event;
use App\Models\Investment;
use GuzzleHttp\Psr7\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil 10 data investor dari database
        $investors = Investor::take(10)->get();

        // Ambil 10 data company dari database
        $companies = Company::getFilteredCompanies();

        // Ambil 5 data people dari database
        $people = People::take(5)->get();

        $events = Event::take(5)->get();

        $investments = Investment::take(10)->get();

        $totalInvestments = Investment::count();

        // Ambil 10 data hubs dari database
        $hubs = Hubs::take(10)->get();

        // Kirim data investor, company, people, dan hubs ke view landingpage
        return view('landingpage', compact('investors', 'companies', 'people', 'hubs','events','investments','totalInvestments'));
    }
}
