<?php

namespace App\Http\Controllers;

use App\Models\Hubs;
use Illuminate\Http\Request;

class HubsController extends Controller
{
    // Index method to display list of hubs with filters
    public function index(Request $request)
    {
        $query = Hubs::query();

        // Filter by location if provided
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by rank if provided
        if ($request->filled('rank')) {
            $query->where('rank', $request->rank);
        }

        // Filter by organization if provided
        if ($request->filled('organization')) {
            $query->where('number_of_organizations', 'like', '%' . $request->organization . '%');
        }

        // Fetch the filtered hubs records
        $hubs = $query->get();

        return view('hubs.index', compact('hubs'));
    }

    // Show method to display specific hub details
    public function show($id)
    {
        // Fetch the specific hub using the ID
        $hub = Hubs::findOrFail($id);

        // Return the hub detail view
        return view('hubs.show', compact('hub'));
    }
}
