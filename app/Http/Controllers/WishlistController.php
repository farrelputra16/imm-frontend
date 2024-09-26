<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'You need to login to save to wishlist.');
        }

        // Ambil user yang login
        $user = Auth::user();

        // Ambil company IDs dari form
        $companyIds = explode(',', $request->input('company_ids'));

        // Simpan setiap company ke wishlist
        foreach ($companyIds as $companyId) {
            // Cek apakah wishlist sudah ada untuk company dan user ini
            $existingWishlist = Wishlist::where('user_id', $user->id)
                                        ->where('company_id', $companyId)
                                        ->first();

            // Jika belum ada, tambahkan ke wishlist
            if (!$existingWishlist) {
                Wishlist::create([
                    'user_id' => $user->id,
                    'company_id' => $companyId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Companies added to wishlist.');
    }

    public function remove(Request $request){
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'You need to login to save to wishlist.');
        }

        // Ambil user yang login
        $user = Auth::user();

        // Ambil company IDs dari form
        $companyIds = explode(',', $request->input('company_ids'));

        // Hapus setiap company dari wishlist
        foreach ($companyIds as $companyId) {
            // Cek apakah wishlist sudah ada untuk company dan user ini
            $existingWishlist = Wishlist::where('user_id', $user->id)
                                        ->where('company_id', $companyId)
                                        ->first();

            // Jika ada, hapus dari wishlist
            if ($existingWishlist) {
                $existingWishlist->delete();
            }
        }

        return redirect()->back()->with('success', 'Companies removed from wishlist.');
    }
}
