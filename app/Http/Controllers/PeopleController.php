<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\People;
use App\Models\Company;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    // Index method to display list of people with filters
    public function index(Request $request)
    {
        $query = People::query()->with('company', 'experiences');
        $rowsPerPage = $request->input('rows', 10);

        // Pencarian global
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('primary_job_title', 'like', "%{$searchTerm}%")
                ->orWhere('primary_organization', 'like', "%{$searchTerm}%")
                ->orWhere('location', 'like', "%{$searchTerm}%")
                ->orWhere('regions', 'like', "%{$searchTerm}%")
                ->orWhere('gmail', 'like', "%{$searchTerm}%")
                ->orWhere('skills', 'like', "%{$searchTerm}%");
            });
        }


        if ($request->filled('Skills')) {
            $Skills = is_array($request->Skills) ? $request->Skills : [$request->Skills];

            $query->where(function ($q) use ($Skills) {
                $matchConditions = [];

                foreach ($Skills as $skill) {
                    // Trim dan normalisasi skill
                    $inputSkill = trim(strtolower($skill));

                    // Berbagai strategi pencarian
                    $matchConditions[] = $q->orWhere(function ($subQuery) use ($inputSkill) {
                        // 1. Pencarian sebagian kata (partial match)
                        $subQuery->whereRaw('LOWER(skills) LIKE ?', ['%' . $inputSkill . '%'])
                            // 2. Pencarian berdasarkan kata yang mirip
                            ->orWhereRaw('SOUNDEX(LOWER(skills)) = SOUNDEX(?)', [$inputSkill]);
                    });
                }
            });

            // Sistem Peringkat Pencarian
            $orderByConditions = [];
            $bindings = [];

            foreach ($Skills as $skill) {
                $inputSkill = trim(strtolower($skill));

                // Prioritas Peringkat:
                // 1. Kecocokan Persis
                // 2. Kecocokan Sebagian
                // 3. Kecocokan Fonetik
                $orderByConditions[] = "WHEN skills = ? THEN 1";
                $orderByConditions[] = "WHEN LOWER(skills) LIKE ? THEN 2";
                $orderByConditions[] = "WHEN SOUNDEX(LOWER(skills)) = SOUNDEX(?) THEN 3";

                // Binding untuk setiap kondisi
                $bindings[] = $inputSkill;       // Exact Match
                $bindings[] = '%' . $inputSkill . '%';  // Partial Match
                $bindings[] = $inputSkill;       // Soundex
            }

            // Kondisi default untuk skill yang tidak cocok
            $orderByConditions[] = "ELSE " . (count($Skills) + 5);

            // Tambahkan ORDER BY dengan kondisi peringkat
            $query->orderByRaw(
                "CASE " . implode(' ', $orderByConditions) . " END",
                $bindings
            );

            // Batasi hasil untuk performa
            $query->limit(100);
        }

        // Filter by experience if provided
        if ($request->filled('experience')) {
            $experiences = is_array($request->experience) ? $request->experience : [$request->experience];

            // Apply the experience filter in the query
            $query->whereHas('experiences', function ($q) use ($experiences) {
                foreach ($experiences as $experience) {
                    $inputExperience = trim(strtolower($experience)); // Normalisasi input
                    $q->orWhere(function ($subQuery) use ($inputExperience) {
                        // 1. Pencarian berdasarkan posisi yang mirip
                        $subQuery->whereRaw('LOWER(position) LIKE ?', ['%' . $inputExperience . '%'])
                            // 2. Pencarian fonetik
                            ->orWhereRaw('SOUNDEX(LOWER(position)) = SOUNDEX(?)', [$inputExperience]);
                    });
                }
            });

            // Dynamically build the order clause based on the number of experiences
            $orderByConditions = [];
            $bindings = [];
            foreach ($experiences as $index => $experience) {
                $inputExperience = trim(strtolower($experience)); // Normalisasi input

                // Prioritas Peringkat:
                // 1. Kecocokan Persis
                // 2. Kecocokan Sebagian
                // 3. Kecocokan Fonetik
                $orderByConditions[] = "WHEN EXISTS (SELECT 1 FROM experiences WHERE LOWER(position) LIKE ?) THEN " . ($index + 1);
                $orderByConditions[] = "WHEN EXISTS (SELECT 1 FROM experiences WHERE SOUNDEX(LOWER(position)) = SOUNDEX(?)) THEN " . (count($experiences) + $index + 1);

                // Binding untuk setiap kondisi
                $bindings[] = '%' . $inputExperience . '%'; // Exact Match
                $bindings[] = $inputExperience; // Soundex
            }

            // Kondisi default untuk pengalaman yang tidak cocok
            $orderByConditions[] = "ELSE " . (count($experiences) * 2 + 1); // Menandakan tidak ada kecocokan

            // Create the full ORDER BY clause
            $query->orderByRaw("CASE " . implode(' ', $orderByConditions) . " END", $bindings);
        }

        // Filter by role if provided
        if ($request->filled('role')) {
            $query->where('role', 'like', '%' . $request->role . '%');
        }

        // Fetch the filtered people records
        $people = $query->paginate($rowsPerPage);

        foreach($people as $person) {
            $latestExperience = $person->experiences->sortByDesc('end_date')->first();
            $person->pengalaman = $latestExperience->position;
        }

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
public function showUpcomingEvents()
{
    // Ambil data event yang akan datang dari tabel 'events'
    $upcomingEvents = Event::orderBy('start', 'asc')->take(4)->get();

    return view('peoplepage.home', compact('upcomingEvents'));
}


}
