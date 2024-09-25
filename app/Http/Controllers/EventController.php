<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{

    public function index()
    {

        $currentDateTime = Carbon::now();

        // Filter events where the deadline is in the future
        $events = Event::withCount('users')
            ->where('deadline', '>', $currentDateTime)
            ->get();

        foreach ($events as $event) {
            $event->content = \Illuminate\Support\Str::limit($event->content, 100, $end = '...');
            $event->cover_img = env('APP_BACKEND_URL') . '/images/' . $event->cover_img;
            $event->hero_img = env('APP_BACKEND_URL') . '/images/' . $event->hero_img;
        }

        $backendUrl = env('APP_BACKEND_URL');

        return view('event.event', compact('events', 'backendUrl'));
    }


    public function hubungiSekarang(Request $request, $event_id)
    {

        $message = urlencode("Saya tertarik untuk kerjasama dalam event dengan ID: {$event_id}");
        $whatsappUrl = "https://api.whatsapp.com/send?phone=6282248339370&text={$message}";

        return redirect()->away($whatsappUrl);
    }


    public function create()
    {
        $users = User::all();
        return view('events.create', compact('users'));
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'topic' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'deadline' => 'required|date',
            'users' => 'array|exists:users,id',
        ]);

        $event = Event::create($validatedData);
        if (isset($validatedData['users'])) {
            $event->users()->attach($validatedData['users']);
        };
        dd($event);
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
