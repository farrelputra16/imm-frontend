<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    // Index method to display list of people with filters
    public function index(Request $request)
    {
        $query = People::query()->with('company');

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
    public function profile()
    {
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Mengambil data people berdasarkan user_id
        $people = People::where('user_id', $userId)->firstOrFail();

        $companies = Company::all();

        // Tampilkan halaman profil
        return view('peoplepage.profile', compact('people','companies'));
    }

    // Menyimpan perubahan profil
    public function updateProfile(Request $request)
    {
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Mengambil data people berdasarkan user_id
        $people = People::where('user_id', $userId)->firstOrFail();

        // Validasi input dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:Mentor,Pekerja,Konsultan',
            'primary_job_title' => 'nullable|string|max:255',
            'primary_organization' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'regions' => 'nullable|string|max:255',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'linkedin_link' => 'nullable|url',
            'description' => 'nullable|string',
            'phone_number' => 'required|string|max:15',
            'gmail' => 'required|email|max:255',
        ]);

        // Update data people berdasarkan input
        $people->update($validatedData);

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('people.home')->with('success', 'Profile updated successfully.');
    }

}

