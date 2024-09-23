<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            $image->move(public_path('images/products'), $imageName); // Menyimpan gambar ke folder 'images/products'
        }

        $product = Product::create([
            'company_id' => $companyId,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imageName, // Simpan nama file gambar
        ]);

        return response()->json($product, 201);
    }

    public function update(Request $request, $companyId, $id)
    {
        $product = Product::where('id', $id)->where('company_id', $companyId)->firstOrFail();
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $oldImageName = $product->image;
    
        if ($request->hasFile('image')) {
            if ($oldImageName && file_exists(public_path('images/products/' . $oldImageName))) {
                unlink(public_path('images/products/' . $oldImageName));
            }
            $image = $request->file('image');
            $newImageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $newImageName);
        } else {
            $newImageName = $oldImageName;
        }
    
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $newImageName,
        ]);
    
        return response()->json($product, 200);
    }
    
    // Fungsi untuk menghapus data
    public function destroy($id)
    {
        // Mencari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Menentukan path file gambar
        $imagePath = public_path('images/products/' . $product->image);

        // Mengecek apakah file gambar ada dan menghapusnya
        if (file_exists($imagePath)) {
            unlink($imagePath); // Menghapus file gambar
        }

        // Menghapus produk dari database
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

}
