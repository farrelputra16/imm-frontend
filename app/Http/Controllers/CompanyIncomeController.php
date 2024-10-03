<?php

namespace App\Http\Controllers;

use App\Models\CompanyIncome;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompanyIncomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $selectedCompany = $user->companies;
    
        if ($selectedCompany) {
            $companyIncomes = $selectedCompany->incomes;
        } else {
            $companyIncomes = collect(); 
        }
        return $companyIncomes;
    }

    public function show(){
        $user = Auth::user();
        $company = $user->companies;
        return view('homepageimm.tambahdana', compact('company'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'company_id' => 'required|integer',
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
