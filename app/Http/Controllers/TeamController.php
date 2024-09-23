<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
        $team = Team::find($id);
        if ($team) {
            return response()->json($team);
        }
        return response()->json(['error' => 'Team member not found'], 404);
    }

   // Update team member
     public function updateTeam(Request $request, $id)
    {
        $team = Team::find($id);
        if ($team) {
            $validated = $request->validate([
                'position' => 'required|string',
            ]);

            $team->position = $validated['position'];
            $team->save();

            return response()->json(['success' => true, 'message' => 'Team member position updated successfully']);
        }
        return response()->json(['error' => 'Team member not found'], 404);
    }


   public function store(Request $request)
   {
       try {
           // Validasi input
           $validated = $request->validate([
               'person_id' => 'required|exists:people,id',
               'company_id' => 'required|exists:companies,id',
               'position' => 'required|string',
           ]);
   
           // Menyimpan anggota tim ke dalam tabel team
           $team = new Team;
           $team->people_id = $validated['person_id'];
           $team->company_id = $validated['company_id'];
           $team->position = $validated['position'];
           $team->save();
   
           return response()->json(['success' => true, 'message' => 'Team member added successfully']);
       } catch (\Exception $e) {
           return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
       }
   }
   
   


   // Delete team member
    public function destroyTeam($id, $companies_id)
   {
       // Menggunakan where untuk mencari berdasarkan people_id dan company_id
       $team = Team::where('people_id', $id)
                   ->where('company_id', $companies_id) // Gunakan where, bukan and
                   ->first();
   
       if ($team) {
           $team->delete();
           return response()->json(['success' => true, 'message' => 'Team member deleted successfully']);
       } else {
           return response()->json(['error' => 'Team member not found'], 404);
       }
   }

}
