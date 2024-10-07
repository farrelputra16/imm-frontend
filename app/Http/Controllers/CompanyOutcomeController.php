<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Project;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Models\CompanyOutcome;
use Illuminate\Routing\Controller;
use App\Mail\ProjectOutcomeUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        return $project;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'jumlah_biaya' => 'required|numeric',
            'keterangan' => 'required|string|max:1000',
            'bukti' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:5000',
            'project_id' => 'required|exists:projects,id',
            'pelaporan_dana' => 'required|string|in:internal,external',
        ]);
    
        $buktiFileName = null;
    
        if ($request->hasFile('bukti')) {
            $buktiFile = $request->file('bukti');
            $buktiFileName = time() . '.' . $buktiFile->getClientOriginalExtension();
    
            // Tentukan direktori berdasarkan pelaporan_dana
            $directory = $validatedData['pelaporan_dana'] === 'external' 
                ? 'public/laporan_pengeluaran_eksternal' 
                : 'public/laporan_pengeluaran_internal';
    
            // Simpan file ke direktori yang sesuai
            $buktiFile->storeAs($directory, $buktiFileName);
        }
    
        $outcome = CompanyOutcome::create([
            'date' => $validatedData['date'],
            'jumlah_biaya' => $validatedData['jumlah_biaya'],
            'keterangan' => $validatedData['keterangan'],
            'bukti' => $buktiFileName,
            'project_id' => $validatedData['project_id'],
            'pelaporan_dana' => $validatedData['pelaporan_dana'],
        ]);

        // AMbils emua investor yang berinvestasi di proyek ini
        $investments = Investment::where('project_id', $validatedData['project_id'])->get();

        foreach ($investments as $investment) {
            $investor = $investment->investor;
            $user = $investor->user;
            $email = $user->email;

            try {
                // Kirim email ke investor
                Mail::to($email)->send(new ProjectOutcomeUpdated($outcome));
            } catch (\Exception $e) {
                // Log error jika email gagal dikirim
                Log::error("Email gagal dikirim ke {$email}: " . $e->getMessage());
            }
        }
    
        return redirect()->route('homepageimm.detailbiaya', ['project_id' => $validatedData['project_id']])
                        ->with('success', 'Penggunaan dana berhasil ditambahkan.');
    }
}
