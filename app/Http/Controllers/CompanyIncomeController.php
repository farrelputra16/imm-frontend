<?php

namespace App\Http\Controllers;

use App\Models\CompanyIncome;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompanyIncomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $selectedCompany = $user->companies()->first(); // Ambil perusahaan pertama yang terkait dengan user

        // Ambil jumlah baris per halaman dari request, default ke 10
        $rowsPerPage = $request->input('rows', 10);
        $searchTerm = $request->input('search_income', ''); // Ambil input pencarian untuk income

        if ($selectedCompany) {
            // Ambil pendapatan perusahaan dengan pagination dan pencarian
            $companyIncomes = $selectedCompany->incomes()
                ->where('pengirim', 'LIKE', "%{$searchTerm}%") // Ganti 'pengirim' dengan kolom yang ingin dicari
                ->orWhere('bank_asal', 'LIKE', "%{$searchTerm}%") // Tambahkan kolom lain jika perlu
                ->paginate($rowsPerPage);

            // Tambahkan label investasi ke setiap income
            foreach ($companyIncomes as $income) {
                $income->investment_type_label = $income->investment_type_label; // Menggunakan accessor
            }
        } else {
            $companyIncomes = collect();
        }

        return $companyIncomes; // Pastikan ini mengembalikan objek LengthAwarePaginator
    }

    public function show()
    {
        $user = Auth::user();
        $company = $user->companies;
        $company->load('projects'); // Memuat proyek terkait
        return view('homepageimm.tambahdana', compact('company'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|integer',
            'project_id' => 'required|integer', // Validasi project_id
            'date' => 'required|date',
            'pengirim' => 'required|string',
            'bank_asal' => 'required|string',
            'bank_tujuan' => 'required|string',
            'jumlah' => 'required|numeric',
            'funding_type' => 'required|string',
            'tipe_investasi' => 'required|string',
        ]);
        CompanyIncome::create($validated);
        return redirect()->route('kelolapengeluaran')->with('success', 'Data pendapatan perusahaan berhasil ditambahkan.');
    }
}
