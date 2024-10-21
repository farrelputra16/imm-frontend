<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Carbon\Carbon;

class InvestorPageController extends Controller
{
    public function index()
    {
        // Mengambil pengguna yang sedang login
        $user = Auth::user();

        if (!$user->investor) {
            // Jika tidak ada data investor, redirect atau tampilkan pesan error
            return redirect()->route('home')->with('error', 'Investor not found.');
        }

        // Mengambil data investor_id dari relasi investor
        $investor_id = $user->investor->id;

        // Menghitung jumlah company yang telah diinvestasikan oleh investor yang sedang login
        $companyFunded = Investment::where('investor_id', $investor_id)
                                   ->distinct('company_id') // Menghitung perusahaan unik
                                   ->count('company_id');

        // Menghitung jumlah transaksi (total baris di tabel investments)
        $transactionCount = Investment::where('investor_id', $investor_id)->count();

        // Menjumlahkan total amount yang diinvestasikan oleh investor
        $totalInvested = Investment::where('investor_id', $investor_id)->sum('amount');

        // Mengambil transaksi terbaru berdasarkan investor yang sedang login
        $recentTransactions = Investment::where('investor_id', $investor_id)
                                         ->with('company') // Memuat relasi company
                                         ->orderBy('investment_date', 'desc')
                                         ->take(7) // Ambil 7 transaksi terbaru
                                         ->get();

        // Mengambil daftar perusahaan yang telah diinvestasikan oleh investor yang login
        $investedCompanies = Investment::where('investor_id', $investor_id)
                                       ->with('company')
                                       ->get();

        // Membuat chart berdasarkan tahun dan jumlah investasi
        $investments = Investment::selectRaw('YEAR(investment_date) as year, SUM(amount) as total')
                                 ->where('investor_id', $investor_id)
                                 ->groupBy('year')
                                 ->orderBy('year', 'asc')
                                 ->get();

        // Ambil tahun dan jumlah amount untuk chart
        $years = $investments->pluck('year')->toArray();
        $amounts = $investments->pluck('total')->toArray();

        // Membuat chart dengan data yang diambil
        $chart2 = new Chart;
        $chart2->labels($years);
        $chart2->dataset('Investment Amount per Year', 'line', $amounts);

        // Kirim data ke view, termasuk companyFunded, transactionCount, dan totalInvested
        return view('investorspage.home', compact('recentTransactions', 'investedCompanies', 'chart2', 'companyFunded', 'transactionCount', 'totalInvested'));
    }
}
