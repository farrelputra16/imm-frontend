<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{

    public function __construct()
    {
        // Terapkan middleware pada metode 'show'
        $this->middleware('checkrole:USER')->only('show');
    }
    // Existing index method
    public function index(Request $request)
{
    $query = Investor::query();
    $rowsPerPage = $request->input('rows', 10);

    // Pencarian global
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('org_name', 'like', "%{$searchTerm}%")
              ->orWhere('number_of_contacts', 'like', "%{$searchTerm}%")
              ->orWhere('number_of_investments', 'like', "%{$searchTerm}%")
              ->orWhere('location', 'like', "%{$searchTerm}%")
              ->orWhere('description', 'like', "%{$searchTerm}%")
              ->orWhere('departments', 'like', "%{$searchTerm}%")
              ->orWhere('investment_stage', 'like', "%{$searchTerm}%");
            //   ->orWhere('investment_type', 'like', "%{$searchTerm}%");
            // Tambahkan kolom lain yang ingin dicari
        });
    }

    // Filter by location if provided
    if ($request->filled('location')) {
        $locations = is_array($request->location) ? $request->location : [$request->location];
        $query->whereIn('location', $locations);
    }

    // Filter by industry if provided
    if ($request->filled('industry')) {
        $industries = is_array($request->industry) ? $request->industry : [$request->industry];
        $query->where(function ($q) use ($industries) {
            foreach ($industries as $industry) {
                $q->orWhere('description', 'like', '%' . $industry . '%');
            }
        });
    }

    // Filter by departments if provided
    if ($request->filled('departments')) {
        $departments = is_array($request->departments) ? $request->departments : [$request->departments];
        $query->where(function ($q) use ($departments) {
            foreach ($departments as $department) {
                $q->orWhere('departments', 'like', '%' . $department . '%');
            }
        });
    }

    // Filter by investment_stage if provided
    if ($request->filled('investment_stage')) {
        $investmentStages = is_array($request->investment_stage) ? $request->investment_stage : [$request->investment_stage];
        $query->whereIn('investment_stage', $investmentStages);
    }

    // Filter by investor_type if provided
    if ($request->filled('investor_type')) {
        $investorTypes = is_array($request->investor_type) ? $request->investor_type : [$request->investor_type];
        $query->whereIn('investor_type', $investorTypes);
    }

    // Paginate the results
    $investors = $query->paginate($rowsPerPage);

    return view('investors.index', compact('investors'));
}

    // New show method
    public function show($id)
    {
        // Fetch the specific investor using the ID
        $investor = Investor::with('investments.company')->findOrFail($id);

        // Return the investor detail view
        return view('investors.show', compact('investor'));
    }
}
