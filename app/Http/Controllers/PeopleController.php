<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    // Index method to display list of people with filters
    public function index(Request $request)
    {
        $query = People::query();

        // Filter by location if provided
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by role if provided
        if ($request->filled('role')) {
            $query->where('role', 'like', '%' . $request->role . '%');
        }

        // Filter by organization if provided
        if ($request->filled('organization')) {
            $query->where('primary_organization', 'like', '%' . $request->organization . '%');
        }

        // Fetch the filtered people records
        $people = $query->get();

        return view('people.index', compact('people'));
    }

    // Show method to display specific person details
    public function show($id)
    {
        // Fetch the specific person using the ID
        $people = People::findOrFail($id);

        // Return the people detail view
        return view('people.show', compact('people'));
    }
}

