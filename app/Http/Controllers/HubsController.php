<?php

namespace App\Http\Controllers;

use App\Models\Hubs;
use App\Models\User;
use App\Models\Event;
use App\Models\People;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HubsController extends Controller
{
    // Index method to display list of hubs with filters
    public function index(Request $request)
    {
        $query = Hubs::approved(); // Hanya menampilkan hubs yang sudah disetujui

        // Filter by provinsi if provided
        if ($request->filled('provinsi')) {
            $query->where('provinsi', 'like', '%' . $request->provinsi . '%');
        }

        // Filter by rank if provided
        if ($request->filled('rank')) {
            $query->where('rank', $request->rank);
        }

        // Fetch the filtered hubs records
        $hubs = $query->get();

        return view('hubs.index', compact('hubs'));
    }

    // Show method to display specific hub details// Show method to display specific hub details
public function show($id)
{
    // Fetch the specific hub using the ID
    $hub = Hubs::findOrFail($id);

    // Ensure the hub is approved before displaying it
    if ($hub->status != 'approved') {
        abort(404);
    }

    // Parse comma-separated strings into arrays
    $facilities = $hub->facilities ? explode(',', $hub->facilities) : [];
    $programs = $hub->programs ? explode(',', $hub->programs) : [];
    $alumni = $hub->alumni ? explode(',', $hub->alumni) : [];

    // Return the hub detail view with facilities, programs, and alumni
    return view('hubs.show', compact('hub', 'facilities', 'programs', 'alumni'));
}


    // Method untuk menampilkan form pengajuan hub
    public function create()
    {
        // Import model yang diperlukan
        $companies = Company::all();
        $people = People::all();
        $events = Event::all();

        return view('hubs.createhubs.create', compact('companies', 'people', 'events'));
    }

    // Method untuk menyimpan data hub baru
    public function store(Request $request)
    {
        // Pastikan pengguna telah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        Log::info('User ID saat ini: ' . auth()->id());

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'rank' => 'nullable|integer',
            'top_investor_types' => 'nullable|string',
            'top_funding_types' => 'nullable|string',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string', // Validasi untuk fasilitas
            'programs' => 'nullable|string',   // Validasi untuk program
            'alumni' => 'nullable|array',  // Alumni harus berupa array karena kita menggunakan multiple select
        'alumni.*' => 'exists:companies,id',  // Setiap alumni harus ada di tabel companies
            // Validasi untuk relasi jika ada
            'company_ids' => 'nullable|array',
            'company_ids.*' => 'exists:companies,id',
            'people_ids' => 'nullable|array',
            'people_ids.*' => 'exists:people,id',
            'event_ids' => 'nullable|array',
            'event_ids.*' => 'exists:events,id',
        ]);

        $alumniString = $request->has('alumni') ? implode(',', $request->alumni) : null;


        // Membuat hub baru dengan status 'pending' dan user_id
        $hub = Hubs::create([
            'name' => $request->name,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'rank' => $request->rank,
            'top_investor_types' => $request->top_investor_types,
            'top_funding_types' => $request->top_funding_types,
            'description' => $request->description,
            'facilities' => $request->facilities,   // Menyimpan fasilitas
            'programs' => $request->programs,       // Menyimpan program
            'alumni' => $request->alumni,           // Menyimpan alumni
            'status' => 'pending',
            'user_id' => auth()->id(), // Menyimpan ID pengguna yang sedang login
        ]);

        // Menyimpan relasi many-to-many jika ada
        if($request->has('alumni')){
            $hub->companies()->attach($request->alumni); // Pastikan alumni adalah array dan gunakan attach untuk menyimpan relasi many-to-many
        }
        $hub->companies()->attach($request->input('company_ids', []));
        $hub->people()->attach($request->input('people_ids', []));
        $hub->events()->attach($request->input('event_ids', []));

        // Redirect dengan pesan sukses
        return redirect()->route('hubs.create.hubsubmission')->with('success', 'Pengajuan hub Anda telah diterima dan menunggu persetujuan.');
    }

    public function mySubmissions()
    {
        // Mengambil pengajuan hubs milik pengguna yang sedang login
        $hubs = Hubs::where('user_id', auth()->id())->get();

        return view('hubs.createhubs.hubsubmission', compact('hubs'));
    }

    // Method untuk admin melihat pengajuan pending
    public function pending()
    {
        // Mengambil hubs dengan status 'pending'
        $hubs = Hubs::where('status', 'pending')->get();
        return view('hubs.pending', compact('hubs'));
    }

    // Method untuk admin menyetujui hub
    public function approve(Hubs $hub)
    {
        $hub->status = 'approved';
        $hub->save();

        return redirect()->route('hubs.pending')->with('success', 'Hub berhasil disetujui.');
    }

    // Method untuk admin menolak hub
    public function reject(Hubs $hub)
    {
        $hub->status = 'rejected';
        $hub->save();

        return redirect()->route('hubs.pending')->with('success', 'Hub berhasil ditolak.');
    }
}
