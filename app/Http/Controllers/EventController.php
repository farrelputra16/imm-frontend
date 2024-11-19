<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventController extends Controller
{

    public function index()
    {
        $islogin = Auth::check();
        $currentDateTime = Carbon::now();

        // Filter events where the start date is in the future
        $events = Event::withCount('users')
            ->where('start', '<', $currentDateTime)
            ->get();

        foreach ($events as $event) {
            $event->description = \Illuminate\Support\Str::limit($event->description, 100, $end = '...');
            $event->cover_img = env('APP_URL'). '/' . $event->cover_img;
            $event->hero_img = env('APP_URL'). '/' . $event->hero_img;
            $event->location = \Illuminate\Support\Str::limit($event->location, 15, $end = '...');
        }

        $Url = env('APP_URL');

        // Inisialisasi $user sebagai null
        $user = null;

        if ($islogin) {
            $user = Auth::user();
        }

        // Gunakan compact dengan variabel yang selalu ada
        return view('event.event', compact('events', 'Url', 'islogin', 'user'));
    }


    public function hubungiSekarang(Request $request, $event_id)
    {

        $message = urlencode("Saya tertarik untuk kerjasama dalam event dengan ID: {$event_id}");
        $whatsappUrl = "https://api.whatsapp.com/send?phone=6282248339370&text={$message}";

        return redirect()->away($whatsappUrl);
    }

    public function create($user_id)
    {
        // Cari user berdasarkan user_id
        $user = User::find($user_id);

        // Periksa apakah user ditemukan
        if (!$user) {
            // Jika user tidak ditemukan, Anda bisa mengarahkan ke halaman lain atau menampilkan pesan error
            return redirect()->route('event.index')->with('error', 'User not found');
        }

        // Tampilkan view dengan data user
        return view('event.create', compact('user'));
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            // User is not logged in, redirect them to the login page
            return redirect('/login');
        }

        $event = Event::findOrFail($id);
        $users = User::all();
        $eventUsers = $event->users->pluck('id')->toArray();
        return view('event.event-register', compact('event', 'users', 'eventUsers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', // Event Name
            'description' => 'required|string', // Deskripsi Event
            'topic' => 'nullable|string|max:255', // Event Theme
            'location' => 'required|string|max:255', // Event Location
            'start' => 'required|date', // Event Date
            'event_duration' => 'required|string|max:255|regex:/^\d{2}\.\d{2} - \d{2}\.\d{2}$/', // Time format: 10.00 - 13.00
            'allowed_participants' => 'nullable|string|max:255', // Who can Attend
            'expected_participants' => 'nullable|integer|min:0', // Expected Number of Participants
            'fee_type' => 'required|in:Free,Paid', // Registration Fee
            'organizer_name' => 'required|string|max:255', // Organizer Name
            'email' => 'required|email|max:255', // Email
            'nomor_tlpn' => 'required|string|max:255', // Phone Number
            'cover_img' => 'nullable|image|max:2048', // Cover Image
            'hero_img' => 'nullable|image|max:2048', // Hero Image
            'users' => 'array|exists:users,id', // Users
        ]);

        // Cek apakah gambar sudah ada di database
        $existingEvent = Event::where('title', $validatedData['title'])->first();

        // Menggunakan slug dari judul event dan timestamp untuk nama file
        $eventTitleSlug = Str::slug($validatedData['title']);
        $timestamp = time();

        // Menyimpan gambar cover jika ada
        if ($request->hasFile('cover_img')) {
            $coverImage = $request->file('cover_img');
            $coverImageName = "{$eventTitleSlug}_cover_{$timestamp}." . $coverImage->getClientOriginalExtension();
            // Menyimpan gambar ke storage/app/public/event
            $coverImage->storeAs('event', $coverImageName, 'public');
            // Simpan nama file dan path lengkap ke validated data
            $validatedData['cover_img'] = 'storage/event/' . $coverImageName; // Path lengkap
        } elseif ($existingEvent) {
            // Jika event sudah ada, gunakan gambar yang ada
            $validatedData['cover_img'] = $existingEvent->cover_img;
        }

        // Menyimpan gambar hero jika ada
        if ($request->hasFile('hero_img')) {
            $heroImage = $request->file('hero_img');
            $heroImageName = "{$eventTitleSlug}_hero_{$timestamp}." . $heroImage->getClientOriginalExtension();
            // Menyimpan gambar ke storage/app/public/event
            $heroImage->storeAs('event', $heroImageName, 'public');
            // Simpan nama file dan path lengkap ke validated data
            $validatedData['hero_img'] = 'storage/event/' . $heroImageName; // Path lengkap
        } elseif ($existingEvent) {
            // Jika event sudah ada, gunakan gambar yang ada
            $validatedData['hero_img'] = $existingEvent->hero_img;
        }

        // Buat event baru atau gunakan event yang sudah ada
        $event = $existingEvent ?: Event::create($validatedData);

        // Jika ada pengguna yang terdaftar, lampirkan ke event
        if (isset($validatedData['users'])) {
            $event->add_user()->sync($validatedData['users']); // Gunakan sync untuk memperbarui relasi
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'pekerjaan' => 'required|string',
            'instansi' => 'nullable|string',
        ]);

        $user = Auth::user();

        $user->pekerjaan = $request->pekerjaan;
        $user->instansi = $request->instansi;

        $user->save;

        $event = Event::findOrFail($request->event_id);
        $user->events->attach($event);

        return view('event.succes', compact('event'));
    }

    public function view($id)
    {
        $event = Event::findOrFail($id);
        $eventUsers = $event->users->pluck('id')->toArray();

        return view('event.event-detail', compact('event', 'eventUsers'));
    }
}
