<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request, $companyId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi gambar
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/projects'), $imageName); // Menyimpan gambar ke folder 'images/projects'
        }

        $project = Project::create([
            'company_id' => $companyId,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imageName, // Simpan nama file gambar
        ]);

        return response()->json($project, 201);
    }

    public function update(Request $request, $companyId, $id)
    {
        $project = Project::where('id', $id)->where('company_id', $companyId)->firstOrFail();
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $oldImageName = $project->image;
    
        if ($request->hasFile('image')) {
            if ($oldImageName && file_exists(public_path('images/projects/' . $oldImageName))) {
                unlink(public_path('images/projects/' . $oldImageName));
            }
            $image = $request->file('image');
            $newImageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/projects'), $newImageName);
        } else {
            $newImageName = $oldImageName;
        }
    
        $project->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $newImageName,
        ]);
    
        return response()->json($project, 200);
    }
    
    // Fungsi untuk menghapus data
    public function destroy($id)
    {
        // Mencari produk berdasarkan ID
        $project = Project::findOrFail($id);

        // Menentukan path file gambar
        $imagePath = public_path('images/projects/' . $project->image);

        // Mengecek apakah file gambar ada dan menghapusnya
        if (file_exists($imagePath)) {
            unlink($imagePath); // Menghapus file gambar
        }

        // Menghapus produk dari database
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully'], 200);
    }

}
