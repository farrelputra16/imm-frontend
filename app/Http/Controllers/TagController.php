<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }
    public function view($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.view', compact('tag'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('images'), $imageName);

        $tag = Tag::create([
            'nama' => $request->input('nama'),
            'img' => $imageName, // Save image paths as a semicolon-separated string
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama' => 'required',
    //         'img' => 'nullable|image|max:5000',
    //     ]);

    //     $tag = new Tag();

    //     $tag->nama = $request->input('nama');

    //     if ($request->hasFile('img')) {
    //         $originalName = $request->img->getClientOriginalName();
    //         $path = $request->img->storeAs('public/img/tags', $originalName);
    //         $tag->img = Storage::url($path);
    //     }

    //     $tag->save();

    //     return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    // }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    // public function update(Request $request, $id)
    // {
    //     $tag = Tag::findOrFail($id);

    //     $request->validate([
    //         'nama' => 'required',
    //         'img' => 'nullable|image|max:5000',
    //     ]);

    //     $tag->nama = $request->input('nama');

    //     if ($request->hasFile('img')) {
    //         $originalName = $request->img->getClientOriginalName();
    //         $path = $request->img->storeAs('public/img/tags', $originalName);
    //         $tag->img = Storage::url($path);
    //     }

    //     $tag->save();

    //     return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    // }

    
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow null for img
        ]);

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($tag->img) {
                Storage::delete('images/' . $tag->img);
            }
            // Simpan gambar yang baru
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $tag->img = $imageName;
        }

        // Update nama dan konten
        $tag->nama = $request->nama;
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        if ($tag->img) {
            Storage::delete($tag->img);
        }
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
