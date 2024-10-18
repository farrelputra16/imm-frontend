<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class InvestorPageController extends Controller
{
    public function index()
{
    $chart1 = new Chart;
    $chart1->labels(['2015', '2016', '2017', '2018', '2019']);
    $chart1->dataset('Chart 1 Data', 'bar', [10000, 20000, 15000, 25000, 30000]);

    $chart2 = new Chart;
    $chart2->labels(['2020', '2021', '2022', '2023', '2024']);
    $chart2->dataset('Chart 2 Data', 'line', [12000, 18000, 22000, 27000, 32000]);

    return view('investorspage.home', compact('chart1', 'chart2'));
}

}
