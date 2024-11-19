<?php

namespace App\Http\Controllers;

use App\Models\Hubs;
use App\Models\Event;
use App\Models\People;
use App\Models\Company;
use App\Models\Investor;
use App\Models\Investment;
use App\Models\FundingRound;
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

        // Ambil 5 data event terbaru berdasarkan created_at
        $events = Event::orderBy('created_at', 'desc')->take(10)->get();

        // Ambil 10 data investments dari database
        $investments = Investment::take(10)->get();

        // Hitung total investments
        $totalInvestments = Investment::count();

        // Bagian funding rounds
        $fundingRounds = FundingRound::all();
        $fundingRoundsCount = FundingRound::count();
        $fundingRoundsTotal = FundingRound::sum('money_raised');
        $fundingRoundsAverage = FundingRound::avg('money_raised');
        $fundingRoundsHighest = FundingRound::max('money_raised');

        // Ambil 10 data hubs dari database
        $hubs = Hubs::take(10)->get();

        // Kirim data investor, company, people, dan hubs ke view landingpage
        return view('landingpage', compact('investors', 'companies', 'people', 'hubs', 'events', 'investments', 'totalInvestments', 'fundingRounds', 'fundingRoundsCount', 'fundingRoundsTotal', 'fundingRoundsAverage', 'fundingRoundsHighest'));
    }
}
