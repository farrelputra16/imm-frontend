<?php

namespace App\Http\Controllers;

use App\Models\CollaborationApplicant;
use App\Models\People;
use Illuminate\Support\Facades\Auth;
use App\Models\Collaboration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CollaborationApplicantController extends Controller
{
    
    // Show the collaboration form
    public function create()
    {
        $collaborations = Collaboration::all(); // Assuming a list of collaborations
        return view('collaboration.create', compact('collaborations'));
    }

    // Store the collaboration applicant
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'collaboration_id' => 'required|exists:collaborations,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle the file upload
        $resumePath = $request->file('resume')->store('resumes', 'public');
        $user = Auth::user();
        // Ambil investor dari user_id yang login
        $people = People::where('user_id', $user->id)->first();
        // Save the data to the CollaborationApplicant model
        CollaborationApplicant::create([
            'collaboration_id' => $request->collaboration_id,
            'people_id' => $people->id, // Assuming the user is authenticated
            'name' => $request->name,
            'position' => $request->position,
            'resume' => $resumePath,
            'status' => 'pending' // default status
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    public function approve($id)
{
    $applicant = CollaborationApplicant::findOrFail($id);
    
    // Update the status to approved
    $applicant->status = 'approve';
    $applicant->save();

    return redirect()->back()->with('success', 'Applicant approved successfully!');
}

public function index($collaborationId)
{
    $collaboration = Collaboration::findOrFail($collaborationId);
    $applicants = CollaborationApplicant::where('collaboration_id', $collaborationId)->paginate(10);
    return view('collaboration.applicants', compact('collaboration', 'applicants'));
}
}