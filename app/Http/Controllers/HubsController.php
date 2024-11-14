<?php

namespace App\Http\Controllers;

use App\Models\Hubs;
use App\Models\User;
use App\Models\Event;
use App\Models\People;
use App\Models\Company;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HubsController extends Controller
{
    // Index method to display list of hubs with filters
    public function index(Request $request)
    {
        $query = Hubs::approved();
        $rowsPerPage = $request->input('rows', 10);

         // Filter berdasarkan rank jika ada
        if ($request->filled('rank')) {
            $rank = (int)$request->rank; // Mengubah rank menjadi integer

            // Tentukan batas atas berdasarkan pilihan
            if ($rank === 10) {
                $query->whereBetween('rank', [1, 10]);
            } elseif ($rank === 50) {
                $query->whereBetween('rank', [1, 50]);
            } elseif ($rank === 100) {
                $query->whereBetween('rank', [1, 100]);
            }
        }

        if ($request->filled('location')) {
            $query->where('kota', 'like', '%' . $request->location . '%');
            $query->orWhere('provinsi', 'like', '%' . $request->province_hidden . '%');
        }

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Mendapatkan id yang buat hub dengan memanfaatkannya dengan user_id

        foreach($query as $hub){
             $user = User::find($hub->user_id);
             $hub->user_id = $user->name;
        }

        $hubs = $query->paginate($rowsPerPage);

        return view('hubs.index', compact('hubs'));
    }

    // Show method to display specific hub details
    public function show($id)
    {
        $hub = Hubs::findOrFail($id);

        if ($hub->status != 'approved') {
            abort(404);
        }

        $facilities = $hub->facilities ? explode(',', $hub->facilities) : [];
        $programs = $hub->programs ? explode(',', $hub->programs) : [];
        $alumni = $hub->alumni ? explode(',', $hub->alumni) : [];

        return view('hubs.show', compact('hub', 'facilities', 'programs', 'alumni'));
    }

    // Method to display form for creating a new hub
    public function create()
    {
        $companies = Company::all();
        $people = People::all();
        $events = Event::all();
        $investors = Investor::all();

        return view('hubs.createhubs.create', compact('companies', 'people', 'events','investors'));
    }

    // Store method to save new hub data
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'programs' => 'nullable|string',
            'alumni' => 'nullable|array',
            'alumni.*' => 'exists:companies,id',
            'type_of_service' => 'nullable|string',
            'purpose' => 'nullable|string',
            'target_scale' => 'nullable|string',
            'location_size' => 'nullable|string',
            'operating_hours' => 'nullable|string',
            'market_and_promotion_plan' => 'nullable|string',
            'target_participant' => 'nullable|string',
            'estimated_user' => 'nullable|integer',
            'benefit' => 'nullable|string',
            'estimated_setup_cost' => 'nullable|numeric',
            'funding_sources' => 'nullable|string',
            'investor_id' => 'nullable|exists:investors,id',
            'company_ids' => 'nullable|array',
            'company_ids.*' => 'exists:companies,id',
            'people_ids' => 'nullable|array',
            'people_ids.*' => 'exists:people,id',
            'event_ids' => 'nullable|array',
            'event_ids.*' => 'exists:events,id',
        ]);

        $alumniString = $request->has('alumni') ? implode(',', $request->alumni) : null;

        $hub = Hubs::create([
            'name' => $request->name,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'description' => $request->description,
            'facilities' => $request->facilities,
            'programs' => $request->programs,
            'alumni' => $alumniString,
            'status' => 'pending',
            'user_id' => auth()->id(),
            'type_of_service' => $request->type_of_service,
            'purpose' => $request->purpose,
            'target_scale' => $request->target_scale,
            'location_size' => $request->location_size,
            'operating_hours' => $request->operating_hours,
            'market_and_promotion_plan' => $request->market_and_promotion_plan,
            'target_participant' => $request->target_participant,
            'estimated_user' => $request->estimated_user,
            'benefit' => $request->benefit,
            'estimated_setup_cost' => $request->estimated_setup_cost,
            'funding_sources' => $request->funding_sources,
            'investor_id' => $request->investor_id,
        ]);

        if ($request->has('alumni')) {
            $hub->companies()->attach($request->alumni);
        }
        $hub->companies()->attach($request->input('company_ids', []));
        $hub->people()->attach($request->input('people_ids', []));
        $hub->events()->attach($request->input('event_ids', []));

        return redirect()->route('hubs.create.hubsubmission')->with('success', 'Pengajuan hub Anda telah diterima dan menunggu persetujuan.');
    }

    public function mySubmissions()
    {
        $hubs = Hubs::where('user_id', auth()->id())->get();
        return view('hubs.createhubs.hubsubmission', compact('hubs'));
    }

    public function pending()
    {
        $hubs = Hubs::where('status', 'pending')->get();
        return view('hubs.pending', compact('hubs'));
    }

    public function approve(Hubs $hub)
    {
        $hub->status = 'approved';
        $hub->save();

        return redirect()->route('hubs.pending')->with('success', 'Hub berhasil disetujui.');
    }

    public function reject(Hubs $hub)
    {
        $hub->status = 'rejected';
        $hub->save();

        return redirect()->route('hubs.pending')->with('success', 'Hub berhasil ditolak.');
    }
}
