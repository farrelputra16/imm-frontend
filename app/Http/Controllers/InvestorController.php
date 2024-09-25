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

        // Filter by location if provided
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by industry if provided
        if ($request->filled('industry')) {
            $query->where('description', 'like', '%' . $request->industry . '%');
        }

        // Filter by departments if provided
        if ($request->filled('departments')) {
            $query->where('departments', 'like', '%' . $request->departments . '%');
        }

        // Paginate the results
        $investors = $query->get();

        return view('investors.index', compact('investors'));
    }

    // New show method
    public function show($id)
    {
        // Fetch the specific investor using the ID
        $investor = Investor::findOrFail($id);

        // Return the investor detail view
        return view('investors.show', compact('investor'));
    }
}
