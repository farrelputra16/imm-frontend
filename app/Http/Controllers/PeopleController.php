<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Company;
use App\Models\Experience;
use App\Models\Education;
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
    public function updateDescription(Request $request)
{
    $request->validate([
        'description' => 'string|max:1000',
    ]);

    $people = People::where('user_id', Auth::id())->firstOrFail();
    $people->description = $request->input('description');
    $people->save();

    return redirect()->back()->with('success', 'Description updated successfully!');
}
public function addExperience(Request $request)
{
    $request->validate([
        'company_id' => 'required|exists:companies,id',
        'position' => 'required|string|max:255',
        'type_of_work' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'description' => 'nullable|string|max:1000',
    ]);

    // Ambil people_id dari pengguna yang sedang login
    $peopleId = People::where('user_id', Auth::id())->firstOrFail()->id;

    // Menambahkan data baru ke database
    Experience::create([
        'company_id' => $request->input('company_id'),
        'people_id' => $peopleId,
        'position' => $request->input('position'),
        'type_of_work' => $request->input('type_of_work'),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'description' => $request->input('description'),
    ]);

    return redirect()->back()->with('success', 'Experience added successfully!');
}

public function addEducation(Request $request)
{
    $request->validate([
        'university' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'field_of_study' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'grade' => 'nullable|string|max:50',
        'activities' => 'nullable|string|max:1000',
        'description' => 'nullable|string|max:1000',
    ]);

    // Mendapatkan people_id dari pengguna yang sedang login
    $peopleId = People::where('user_id', Auth::id())->firstOrFail()->id;

    // Menyimpan data pendidikan baru
    Education::create([
        'people_id' => $peopleId,
        'university' => $request->input('university'),
        'title' => $request->input('title'),
        'field_of_study' => $request->input('field_of_study'),
        'location' => $request->input('location'),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'grade' => $request->input('grade'),
        'activities' => $request->input('activities'),
        'description' => $request->input('description'),
    ]);

    return redirect()->back()->with('success', 'Education added successfully!');
}
public function addSkills(Request $request)
{
    $request->validate([
        'skills.*' => 'required|string|max:255',
    ]);

    // Menggabungkan skill baru yang diinput oleh pengguna
    $newSkills = implode(',', $request->input('skills'));

    // Mendapatkan people_id dari pengguna yang sedang login
    $people = People::where('user_id', Auth::id())->firstOrFail();

    // Jika ada skills sebelumnya, tambahkan koma sebagai pemisah sebelum skill baru
    if (!empty($people->skills)) {
        $updatedSkills = $people->skills . ',' . $newSkills;
    } else {
        $updatedSkills = $newSkills;
    }

    // Simpan skills yang diperbarui ke database
    $people->skills = $updatedSkills;
    $people->save();

    return redirect()->back()->with('success', 'Skills added successfully!');
}

public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'primary_job_title' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'linkedin_link' => 'required|url',
    ]);

    // Ambil people_id dari pengguna yang sedang login
    $people = People::where('user_id', Auth::id())->firstOrFail();

    // Update profil dengan data dari form
    $people->update([
        'name' => $request->input('name'),
        'primary_job_title' => $request->input('primary_job_title'),
        'location' => $request->input('location'),
        'linkedin_link' => $request->input('linkedin_link'),
    ]);

    return redirect()->back()->with('success', 'Profile updated successfully!');
}

    
}

