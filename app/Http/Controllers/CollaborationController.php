<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollaborationController extends Controller
{
    // Menampilkan daftar kolaborasi
    public function index(Request $request)
    {
        $rowsperpage = $request->input('rowsperpage', 10);
        $collaborations = Collaboration::paginate($rowsperpage);
        return view('collaboration.index', compact('collaborations'));
    }

    // Menampilkan form register kolaborasi
    public function create()
    {
        return view('collaboration.register');
    }

    // Menyimpan kolaborasi baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'position' => 'required|array',
            'position.*' => 'string|max:255'
        ]);

        $user = Auth::user();

        // Dapatkan perusahaan yang terhubung dengan user
        $company = Company::where('user_id', $user->id)->first();

        // Upload image
        $imagePath = $request->file('image')->store('public/collaborations');

        // Gabungkan posisi menjadi string dengan pemisah koma
        $positionsString = implode(', ', $request->position);

        // Menyimpan data kolaborasi
        $collaboration = Collaboration::create([
            'company_id' => $company->id,
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
            'position' => $positionsString, // Simpan sebagai string
        ]);

        return redirect()->route('collaboration.index')->with('success', 'Collaboration registered successfully');
    }

    // Menampilkan form edit kolaborasi
    public function edit($id)
    {
        $collaboration = Collaboration::findOrFail($id);
        return view('collaboration.edit', compact('collaboration'));
    }

    // Menyimpan perubahan kolaborasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image',
            'description' => 'required|string',
            'positions' => 'required|array',
        ]);

        $collaboration = Collaboration::findOrFail($id);

        $collaboration->update([
            'title' => $request->title,
            'description' => $request->description,
            'positions' => $request->positions,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/collaborations');
            $collaboration->update(['image' => $imagePath]);
        }

        return redirect()->route('collaboration.index')->with('success', 'Collaboration updated successfully');
    }
}
