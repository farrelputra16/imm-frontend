<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use App\Models\Tag;
use App\Models\Sdg;
use App\Models\Indicator;
use App\Models\Metric;
use App\Models\TargetPelanggan;
use App\Models\Dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
    
        $allProjectsQuery = Project::with('tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan', 'dana')
            ->whereHas('company', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
    
        if ($search) {
            $allProjectsQuery->where('nama', 'like', '%' . $search . '%');
        }
    
        $allProjects = $allProjectsQuery->get();
        $ongoingProjects = $allProjects->where('status', 'Belum selesai');
        $completedProjects = $allProjects->where('status', 'Selesai');
    
        return view('myproject.myproject', compact('allProjects', 'ongoingProjects', 'completedProjects', 'search'));
    }
    


    public function create()
    {
        $companies = Company::all();
        $tags = Tag::all();
        $sdgs = Sdg::all();
        $indicators = Indicator::all();
        $metrics = Metric::all();
        $targetPelanggan = TargetPelanggan::all();
        $dana = Dana::all();

        return view('myproject.creatproject.creatproject', compact('companies', 'tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan', 'dana'));
    }

    public function filterMetrics(Request $request)
    {
        $tagIds = $request->input('tag_ids', []);
        $indicatorIds = $request->input('indicator_ids', []);

        $metricsQuery = Metric::query()
            ->orWhereHas('tags', function ($query) use ($tagIds) {
                $query->whereIn('tags.id', $tagIds);
            })
            ->orWhereHas('indicators', function ($query) use ($indicatorIds) {
                $query->whereIn('indicators.id', $indicatorIds);
            })
            ->with('relatedMetrics');

        $perPage = 10;
        $metrics = $metricsQuery->paginate($perPage);

        return response()->json($metrics);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'tujuan' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'gmaps' => 'required|string',
            'jumlah_pendanaan' => 'required|numeric',
            'dana' => 'required|array',
            'dana.*.jenis_dana' => 'required|string',
            'dana.*.nominal' => 'required|numeric',
            'company_id' => 'required|exists:companies,id',
            'tag_ids' => 'array',
            'tag_ids.*' => 'exists:tags,id',
            'sdg_ids' => 'array',
            'sdg_ids.*' => 'exists:sdgs,id',
            'indicator_ids' => 'array',
            'indicator_ids.*' => 'exists:indicators,id',
            'metric_ids' => 'array',
            'metric_ids.*' => 'exists:metrics,id',
            'target_pelanggans' => 'array',
            'target_pelanggans.*.status' => 'nullable|string',
            'target_pelanggans.*.rentang_usia' => 'nullable|string',
            'target_pelanggans.*.deskripsi_pelanggan' => 'nullable|string',
        ]);

        $validatedData['status'] = 'Belum selesai';

        // Handle image upload
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $validatedData['img'] = $imageName;
        }

        // Create project
        $project = Project::create($validatedData);

        // Attach related models
        $project->tags()->attach($request->input('tag_ids'));
        $project->sdgs()->attach($request->input('sdg_ids'));
        $project->indicators()->attach($request->input('indicator_ids'));
        $project->metrics()->attach($request->input('metric_ids'));

        // Save dana (funding) data
        if ($request->has('dana')) {
            foreach ($request->dana as $dana) {
                $project->dana()->create([
                    'jenis_dana' => $dana['jenis_dana'],
                    'nominal' => $dana['nominal'],
                ]);
            }
        }

        // Save target customers
        if ($request->has('target_pelanggans')) {
            foreach ($request->target_pelanggans as $target) {
                $project->targetPelanggan()->create([
                    'status' => $target['status'],
                    'rentang_usia' => $target['rentang_usia'],
                    'deskripsi_pelanggan' => $target['deskripsi_pelanggan'],
                ]);
            }
        }

        return redirect()->route('myproject.myproject')->with('success', 'Project created successfully');
    }


    public function edit($id)
    {
        $project = Project::with(['tags', 'sdgs', 'metrics', 'targetPelanggan', 'dana'])->findOrFail($id);
        $companies = Company::all();
        $tags = Tag::all();
        $sdgs = Sdg::with('indicators')->get();
        $indicators = Indicator::all();
        $metrics = Metric::all();
        $targetPelanggan = TargetPelanggan::all();

        return view('projects.edit', compact('project', 'companies', 'tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan'));
    }

    function relationshipsToArray($model)
    {
        $data = $model->toArray();
        foreach ($model->getRelations() as $relation => $value) {
            $data[$relation] = $value->toArray();
        }
        return $data;
    }

    public function view($id)
    {
        $project = Project::with('tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan', 'dana', 'surveys')->findOrFail($id);
        $documents = DB::table('project_dokumen')->where('project_id', $id)->get();
        $initialMetricProjects = $project->metricProjects()->whereNull('report_month')->whereNull('report_year')->get();

        $projectData = $this->relationshipsToArray($project);
        $projectData['documents'] = $documents->toArray();

        Log::debug('Project Viewed (All Data):', $projectData);

        return view('myproject.detail', compact('project', 'documents', 'initialMetricProjects'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10000',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        $project->nama = $request->nama;
        $project->deskripsi = $request->deskripsi;

        if ($request->hasFile('img')) {
            // Delete old image if it exists
            if ($project->img) {
                File::delete(public_path('images/' . $project->img));
            }
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $project->img = $imageName;
        }

        $project->save();

        if ($request->hasFile('documents')) {
            Log::debug('Handling document uploads');
            foreach ($request->file('documents') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('files'), $filename);
                Log::debug('File uploaded', ['filename' => $filename]);

                DB::table('project_dokumen')->insert([
                    'project_id' => $project->id,
                    'dokumen_validitas' => $filename,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                Log::debug('Document inserted', ['filename' => $filename]);
            }
        }

        if ($request->has('delete_documents')) {
            Log::debug('Handling document deletions', ['delete_documents' => $request->delete_documents]);
            foreach ($request->delete_documents as $docId) {
                $document = DB::table('project_dokumen')->where('id', $docId)->first();
                if ($document) {
                    File::delete(public_path('files/' . $document->dokumen_validitas));
                    Log::debug('File deleted', ['filename' => $document->dokumen_validitas]);
                    DB::table('project_dokumen')->where('id', $docId)->delete();
                    Log::debug('Document record deleted', ['docId' => $docId]);
                }
            }
        }

        Log::debug('Update method completed successfully');
        return redirect()->back()->with('success', 'Project updated successfully');
    }

    public function complete(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:255',
            'tanggal_penyelesaian' => 'required|date',
        ]);

        $project->status = $request->status;
        $project->tanggal_penyelesaian = $request->tanggal_penyelesaian;

        $project->save();

        return redirect()->route('myproject.myproject')->with('success', 'Project has been marked as completed.');
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return redirect()->route('projects.index')->with('success', 'Project deleted successfull');
    }

    /**
     * Menambahkan untuk menampilkan detail project tanpa dapat dirubah khusus bagi investor
     */
    public function show($id)
    {
        // Ambil proyek beserta relasinya
        $project = Project::with('tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan', 'dana', 'surveys')->findOrFail($id);
        
        // Ambil dokumen proyek dari tabel project_dokumen
        $documents = DB::table('project_dokumen')->where('project_id', $id)->get();

        // Ambil metrics yang belum memiliki report_month dan report_year
        $initialMetricProjects = $project->metricProjects()->whereNull('report_month')->whereNull('report_year')->get();

        // Ubah relasi proyek ke dalam array untuk keperluan logging
        $projectData = $this->relationshipsToArray($project);
        
        // Tambahkan dokumen ke dalam data proyek
        $projectData['documents'] = $documents->toArray();

        // Logging data proyek untuk debugging
        Log::debug('Project Viewed (All Data):', $projectData);

        // Kirim data ke view
        return view('companies.project-detail', compact('project', 'documents', 'initialMetricProjects'));
    }

    public function showProjectWithDanas($id)
    {
        $company = Company::findOrFail($id);
        $projects = $company->projects()->with('dana')->get();
        return $projects;
    }

}
