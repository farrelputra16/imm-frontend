<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\People;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function searchPeople(Request $request)
    {
        // Mencari berdasarkan nama atau email
        $query = $request->query('query');

        $people = People::where('name', 'like', '%' . $query . '%')
            ->orWhere('gmail', 'like', '%' . $query . '%')
            ->get();

        return response()->json($people);
    }

    // Fetch data for the Edit modal
    public function editTeam($id)
    {
        $team = Team::with('person')
        ->where('people_id', $id)
        ->first();

        if (!$team) {
            return response()->json(null);
        }

        return response()->json([
            'id' => $team->people_id,
            'name' => $team->person->name,
            'position' => $team->position,
            'primary_job_title' => $team->primary_job_title,
            'company_id' => $team->company_id,
            'image' => $team->image ? env('APP_URL') . $team->image : null
        ]);
    }

    // Update team member
    public function updateTeam(Request $request, $id)
    {
        $team = Team::where('people_id', $id)->first();
        if (!$team) {
            return response()->json(['success' => false, 'message' => 'Team member not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|exists:departments,id', // Memastikan ID departemen valid
            'position_title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data team
        $team->position = $validated['position']; // Ini sekarang adalah ID departemen
        $team->primary_job_title = $validated['position_title'];

        // Update data person
        $person = $team->person;
        $person->name = $validated['name'];
        $person->save();

        $imageUrl = $team->image;

        // Handle image upload
        if ($request->hasFile('image')) {
            // ... [kode upload gambar tetap sama] ...
        }

        $team->save();

        // Ambil nama departemen
        $department = Department::find($validated['position']);
        $departmentName = $department ? $department->name : 'No department assigned';

        return response()->json([
            'success' => true,
            'message' => 'Team member updated successfully',
            'data' => [
                'id' => $team->people_id,
                'name' => $person->name,
                'position' => $validated['position'], // ID departemen
                'position_title' => $team->primary_job_title,
                'department_name' => $departmentName, // Nama departemen
                'company_id' => $team->company_id,
                'image_url' => $imageUrl ? asset($imageUrl) : null,
            ]
        ]);
    }


    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'person_id' => 'required|exists:people,id',
                'company_id' => 'required|exists:companies,id',
                'position' => 'required|int',
                'primary_job_title' => 'required|string',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:102400', // Maksimal 100MB
            ]);

            // Menyimpan anggota tim ke dalam tabel team
            $team = new Team;
            $team->people_id = $validated['person_id'];
            $team->company_id = $validated['company_id'];
            $team->position = $validated['position'];
            $team->primary_job_title = $validated['primary_job_title'];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName(); // Mengambil nama asli file

                // Mengambil nama perusahaan untuk digunakan dalam path
                $company = Company::find($validated['company_id']);
                $folderName = strtolower(str_replace(' ', '_', $company->nama)); // Membuat nama folder dari nama perusahaan
                $path = $image->storeAs("public/{$folderName}/team", $imageName); // Menyimpan di folder sesuai nama perusahaan
                $team->image = Storage::url($path); // Simpan URL gambar
            }

            // Simpan anggota tim hanya sekali setelah semua atribut diatur
            $team->save();

            // Ambil data anggota tim yang baru ditambahkan
            $person = $team->person; // Ambil data orang yang terkait
            $department = Department::find($team->position); // Ambil nama departemen
            $departmentName = $department ? $department->name : 'No department assigned';

            return response()->json([
                'success' => true,
                'message' => 'Team member added successfully',
                'data' => [
                    'id' => $team->people_id,
                    'name' => $person->name,
                    'email' => $person->gmail,
                    'position' => $team->position,
                    'position_title' => $team->primary_job_title,
                    'department_name' => $departmentName,
                    'image_url' => $team->image ? asset($team->image) : null,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    // delete team member
    public function destroyTeam($id, $companies_id)
    {
        $team = Team::where('people_id', $id)
                    ->where('company_id', $companies_id)
                    ->first();

        if ($team) {
            // Hapus gambar jika ada
            if ($team->image) {
                $imagePath = str_replace('/storage/', 'public/', $team->image);
                Storage::delete($imagePath);
            }

            $team->delete();
            return response()->json(['success' => true, 'message' => 'Team member deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Team member not found'], 404);
        }
    }
}
