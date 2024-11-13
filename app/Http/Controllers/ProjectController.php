<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use App\Models\Tag;
use App\Models\Dana;
use App\Models\Metric;
use App\Models\Company;
use App\Models\Project;
use App\Models\Indicator;
use Illuminate\Http\Request;
use App\Models\TargetPelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // Cek apakah role pengguna adalah "USER"
        $isUserRole = $user->role === 'USER';
        $search = $request->input('search');

        if ($isUserRole) {
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

            return view('myproject.myproject', compact('allProjects', 'ongoingProjects', 'completedProjects', 'search', 'isUserRole'));
        } else {
            $companyId = $request->input('company_id'); // Mengambil company_id dari request
            $rowsPerPage = $request->input('rows', 10); // Default 10 rows per page

            // Pastikan company_id ada dan valid
            if (!$companyId) {
                return redirect()->back()->with('error', 'Company ID tidak valid.');
            }

            $allProjectsQuery = Project::with('tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan', 'dana')
                ->whereHas('company', function ($query) use ($companyId) {
                    $query->where('id', $companyId); // Filter berdasarkan company_id
                });

            if ($search) {
                $allProjectsQuery->where('nama', 'like', '%' . $search . '%');
            }

            $ongoingProjects = $allProjectsQuery->where('status', 'Belum selesai')->paginate($rowsPerPage)->appends(['search' => $search, 'rows' => $rowsPerPage]);
            $completedProjects = $allProjectsQuery->where('status', 'Selesai')->paginate($rowsPerPage)->appends(['search' => $search, 'rows' => $rowsPerPage]);

            return view('myproject.myproject', compact('ongoingProjects', 'completedProjects', 'search', 'isUserRole', 'rowsPerPage', 'companyId'));
        }
    }

    public function create()
    {
        $companies = Company::all();
        $tags = Tag::all();
        $sdgs = Sdg::all();
        $indicators = Indicator::all();
        $metrics = Metric::all();
        $targetPelanggan = TargetPelanggan::all();

        return view('myproject.creatproject.creatproject', compact('companies', 'tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan'));
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
        ddd($request->all());
        try {
            $validatedData = $request->validate([
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
                'nama' => 'required|string',
                'deskripsi' => 'required|string',
                'tujuan' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'provinsi' => 'required|string',
                'kota' => 'required|string',
                'gmaps' => 'nullable|string',
                'latitude' => 'required|numeric', // Ubah ke required jika ingin memastikan ada
                'longitude' => 'required|numeric', // Ubah ke required jika ingin memastikan ada
                'jumlah_pendanaan' => 'required|numeric',
                'pitch_deck' => 'nullable|file|mimes:pdf,ppt,pptx|max:10000',
                'video_pitch' => 'nullable|mimes:mp4,mov,avi,3gp,wmv,flv|max:100000',
                'roadmap' => 'nullable|file|mimes:pdf,ppt,pptx|max:10000',
                'company_id' => 'required|exists:companies,id',
                'tag_ids' => 'nullable|array',
                'tag_ids.*' => 'exists:tags,id',
                'sdg_ids' => 'nullable|array',
                'sdg_ids.*' => 'exists:sdgs,id',
                'indicator_ids' => 'nullable|array',
                'indicator_ids.*' => 'exists:indicators,id',
                'metric_ids' => 'nullable|array',
                'metric_ids.*' => 'exists:metrics,id',
                'target_pelanggans' => 'nullable|array',
                'target_pelanggans.*.status' => 'nullable|string',
                'target_pelanggans.*.rentang_usia' => 'nullable|string',
                'target_pelanggans.*.deskripsi_pelanggan' => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Mengambil pesan kesalahan
            $errors = $e->validator->errors();
            // Mengembalikan kembali dengan pesan kesalahan
            return back()->withErrors($errors)->withInput();
        }
        $validatedData['status'] = 'Belum selesai';

        // Tentukan path untuk folder project
        $projectFolder = 'public/project/' . $validatedData['nama'];

        // Handle image upload
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->storeAs($projectFolder, $imageName);
            $validatedData['img'] = $imageName;
        }

        // Handle pitch deck upload
        if ($request->hasFile('pitch_deck')) {
            $pitchDeckName = time() . '-pitch-deck.' . $request->pitch_deck->extension();
            $request->pitch_deck->storeAs($projectFolder, $pitchDeckName);
            $validatedData['pitch_deck'] = $pitchDeckName;
        }

        // Handle video upload
        if ($request->hasFile('video_pitch')) {
            $videoName = time() . '-video-pitch.' . $request->video_pitch->extension();
            $request->video_pitch->storeAs($projectFolder, $videoName);
            $validatedData['video_pitch'] = $videoName;
        }

        // Handle roadmap upload
        if ($request->hasFile('roadmap')) {
            $roadmapName = time() . '-roadmap.' . $request->roadmap->extension();
            $request->roadmap->storeAs($projectFolder, $roadmapName);
            $validatedData['roadmap'] = $roadmapName;
        }

        // Create project
        $project = Project::create($validatedData);

        // Attach related models if they exist
        if ($request->has('tag_ids')) {
            $project->tags()->attach($request->input('tag_ids'));
        }

        if ($request->has('sdg_ids')) {
            $project->sdgs()->attach($request->input('sdg_ids'));
        }

        if ($request->has('indicator_ids')) {
            $project->indicators()->attach($request->input('indicator_ids'));
        }

        if ($request->has('metric_ids')) {
            $project->metrics()->attach($request->input('metric_ids'));
        }

        // Save target customers if they exist
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


        // Cek apakah role pengguna adalah "USER"
        $isUserRole = Auth::user()->role === 'USER';

        $projectData = $this->relationshipsToArray($project);
        $projectData['documents'] = $documents->toArray();

        Log::debug('Project Viewed (All Data):', $projectData);

        return view('myproject.detail', compact('project', 'documents', 'initialMetricProjects', 'isUserRole'));
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
                Storage::delete('public/project/' . $project->nama . '/' . $project->img);
            }
            $imageName = time() . '.' . $request->img->extension();
            $request->img->storeAs('public/project/' . $project->nama, $imageName);
            $project->img = $imageName;
        }

        $project->save();

        if ($request->hasFile('documents')) {
            Log::debug('Handling document uploads');
            foreach ($request->file('documents') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('public/project/' . $project->nama, $filename);
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
                    Storage::delete('public/project/' . $project->nama . '/' . $document->dokumen_validitas);
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

    // /**
    //  * Menambahkan untuk menampilkan detail project tanpa dapat dirubah khusus bagi investor
    //  */
    // public function show($id)
    // {
    //     // Ambil proyek beserta relasinya
    //     $project = Project::with('tags', 'sdgs', 'indicators', 'metrics', 'targetPelanggan', 'dana', 'surveys')->findOrFail($id);

    //     // Ambil dokumen proyek dari tabel project_dokumen
    //     $documents = DB::table('project_dokumen')->where('project_id', $id)->get();

    //     // Ambil metrics yang belum memiliki report_month dan report_year
    //     $initialMetricProjects = $project->metricProjects()->whereNull('report_month')->whereNull('report_year')->get();

    //     // Ubah relasi proyek ke dalam array untuk keperluan logging
    //     $projectData = $this->relationshipsToArray($project);

    //     // Tambahkan dokumen ke dalam data proyek
    //     $projectData['documents'] = $documents->toArray();

    //     // Logging data proyek untuk debugging
    //     Log::debug('Project Viewed (All Data):', $projectData);

    //     // Kirim data ke view
    //     return view('companies.project-detail', compact('project', 'documents', 'initialMetricProjects'));
    // }

    public function showProject($id, Request $request)
    {
        $company = Company::findOrFail($id);

        // Ambil jumlah baris per halaman dari request, default ke 10
        $rowsPerPage = $request->input('rows', 10);
        $searchTerm = $request->input('search_expense', ''); // Ambil input pencarian untuk expense

        // Ambil proyek terkait dengan perusahaan dan paginate dengan pencarian
        $projects = $company->projects()
            ->where('nama', 'LIKE', "%{$searchTerm}%") // Ganti 'nama' dengan kolom yang ingin dicari
            ->paginate($rowsPerPage);

        return $projects; // Pastikan ini mengembalikan objek LengthAwarePaginator
    }
}
