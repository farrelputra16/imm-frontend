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
}
