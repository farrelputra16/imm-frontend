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

        if ($user->role === 'USER') {
            // Ambil investor IDs dari form
            $investorIds = explode(',', $request->input('investor_ids'));
            ddd($investorIds);

            // Simpan setiap investor ke wishlist
            foreach ($investorIds as $investorId) {
                // Pastikan ID tidak kosong
                if (!empty($investorId)) {
                    // Cek apakah wishlist sudah ada untuk investor dan user ini
                    $existingWishlist = Wishlist::where('user_id', $user->id)
                        ->where('investor_id', $investorId)
                        ->first();

                    // Jika belum ada, tambahkan ke wishlist
                    if (!$existingWishlist) {
                        Wishlist::create([
                            'user_id' => $user->id,
                            'investor_id' => $investorId,
                        ]);
                    }
                }
            }
        } else if ($user->role === 'INVESTOR') {
            // Ambil company IDs dari form
            $companyIds = explode(',', $request->input('company_ids'));

            // Simpan setiap company ke wishlist
            foreach ($companyIds as $companyId) {
                // Pastikan ID tidak kosong
                if (!empty($companyId)) {
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
            }
        } else if ($user->role === 'PEOPLE') {
            // Ambil people IDs dari form
            $peopleIds = explode(',', $request->input('people_ids'));

            // Simpan setiap people ke wishlist
            foreach ($peopleIds as $peopleId) {
                // Pastikan ID tidak kosong
                if (!empty($peopleId)) {
                    // Cek apakah wishlist sudah ada untuk people dan user ini
                    $existingWishlist = Wishlist::where('user_id', $user->id)
                        ->where('people_id', $peopleId)
                        ->first();

                    // Jika belum ada, tambahkan ke wishlist
                    if (!$existingWishlist) {
                        Wishlist::create([
                            'user_id' => $user->id,
                            'people_id' => $peopleId,
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Companies added to wishlist.');
    }

    public function remove(Request $request)
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'You need to login to remove from wishlist.');
        }

        // Ambil user yang login
        $user = Auth::user();

        // Cek role pengguna
        if ($user->role === 'USER') {
            // Ambil investor IDs dari form
            $investorIds = explode(',', $request->input('investor_ids'));

            // Hapus setiap investor dari wishlist
            foreach ($investorIds as $investorId) {
                // Pastikan ID tidak kosong
                if (!empty($investorId)) {
                    // Cek apakah wishlist sudah ada untuk investor dan user ini
                    $existingWishlist = Wishlist::where('user_id', $user->id)
                        ->where('investor_id', $investorId)
                        ->first();

                    // Jika ada, hapus dari wishlist
                    if ($existingWishlist) {
                        $existingWishlist->delete();
                    }
                }
            }
        } else if ($user->role === 'INVESTOR') {
            // Ambil company IDs dari form
            $companyIds = explode(',', $request->input('company_ids'));

            // Hapus setiap company dari wishlist
            foreach ($companyIds as $companyId) {
                // Pastikan ID tidak kosong
                if (!empty($companyId)) {
                    // Cek apakah wishlist sudah ada untuk company dan user ini
                    $existingWishlist = Wishlist::where('user_id', $user->id)
                        ->where('company_id', $companyId)
                        ->first();

                    // Jika ada, hapus dari wishlist
                    if ($existingWishlist) {
                        $existingWishlist->delete();
                    }
                }
            }
        } else if ($user->role === 'PEOPLE') {
            // Ambil people IDs dari form
            $peopleIds = explode(',', $request->input('people_ids'));

            // Hapus setiap people dari wishlist
            foreach ($peopleIds as $peopleId) {
                // Pastikan ID tidak kosong
                if (!empty($peopleId)) {
                    // Cek apakah wishlist sudah ada untuk people dan user ini
                    $existingWishlist = Wishlist::where('user_id', $user->id)
                        ->where('people_id', $peopleId)
                        ->first();

                    // Jika ada, hapus dari wishlist
                    if ($existingWishlist) {
                        $existingWishlist->delete();
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Items removed from wishlist.');
    }
}
