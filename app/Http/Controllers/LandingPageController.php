<?php

namespace App\Http\Controllers;

use App\Models\Investor;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil semua data investor dari database
        $investors = Investor::take(10)->get();

        // Kirim data investor ke view landingpage
        return view('landingpage', compact('investors'));
    }
}
