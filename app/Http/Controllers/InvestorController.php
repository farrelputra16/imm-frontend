<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Department;
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
            $query->where(function ($q) use ($locations) {
                foreach ($locations as $location) {
                    $q->orWhere('location', 'like', "%{$location}%");
                }
            });
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
        if ($request->input('departments') && !empty($request->input('departments'))) {
            $query->whereHas('departments', function ($query) use ($request) {
                $query->whereIn('name', $request->input('departments'));
            });
        }

       // Filter by investment_stage if provided
        if ($request->filled('investment_stage')) {
            $investmentStages = is_array($request->investment_stage) ? $request->investment_stage : [$request->investment_stage];
            $query->where(function ($q) use ($investmentStages) {
                foreach ($investmentStages as $stage) {
                    $q->orWhere('investment_stage', 'like', '%' . $stage . '%');
                }
            });
        }

        // Filter by investor_type if provided
        if ($request->filled('investor_type')) {
            $investorTypes = is_array($request->investor_type) ? $request->investor_type : [$request->investor_type];
            $query->where(function ($q) use ($investorTypes) {
                foreach ($investorTypes as $type) {
                    $q->orWhere('investor_type', 'like', '%' . $type . '%');
                }
            });
        }

        // Paginate the results
        $investors = $query->paginate($rowsPerPage);
        $department = Department::all();

        return view('investors.index', compact('investors', 'department'));
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
