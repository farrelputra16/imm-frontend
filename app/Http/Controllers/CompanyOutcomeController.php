<?php
namespace App\Http\Controllers;

use App\Models\CompanyOutcome;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompanyOutcomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $company = $user->companies; // Mengambil company terkait dengan user
                
        if (!$company) {
            // Handle jika user tidak terhubung dengan company
            return redirect()->back()->with('error', 'User tidak terhubung dengan company.');
        }
        
        $companyId = $company->id;
        
        $projects = Project::where('company_id', $companyId);

        if ($request->has('search')) {
            $search = $request->input('search');
            $projects->where('nama', 'like', '%' . $search . '%');
        }
        $projects = $projects->get();
        return $projects;
    }

    public function detailOutcome($project_id)
    {
        $outcomes = CompanyOutcome::where('project_id', $project_id)->get();
        
        $project = Project::findOrFail($project_id);
    
        if ($outcomes->isEmpty()) {
            return view('homepageimm.detailbiaya', ['project_id' => $project_id, 'outcomes' => collect(), 'project' => $project]);
        }
    
        return view('homepageimm.detailbiaya', compact('outcomes', 'project_id', 'project'));
    }
    

    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);
        return view('homepageimm.tambahpenggunaandana', compact('project_id'));
        
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'jumlah_biaya' => 'required|numeric',
            'category' => 'required|string|max:255',
            'keterangan' => 'required|string|max:1000',
            'bukti' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:5000',
            'project_id' => 'required|exists:projects,id',
        ]);

        $buktiFileName = null;

        if ($request->hasFile('bukti')) {
            $buktiFile = $request->file('bukti');
            $buktiFileName = time() . '.' . $buktiFile->getClientOriginalExtension();
            $buktiFile->move(public_path('images'), $buktiFileName);
        }

        CompanyOutcome::create([
            'date' => $validatedData['date'],
            'category' => $validatedData['category'],
            'jumlah_biaya' => $validatedData['jumlah_biaya'],
            'keterangan' => $validatedData['keterangan'],
            'bukti' => $buktiFileName,
            'project_id' => $validatedData['project_id'],
        ]);

        return redirect()->route('homepageimm.detailbiaya', ['project_id' => $validatedData['project_id']])
                        ->with('success', 'Penggunaan dana berhasil ditambahkan.');
    }
}
