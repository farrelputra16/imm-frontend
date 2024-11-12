<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Company;
use App\Models\Investor;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        // Ambil IDs dari form berdasarkan peran pengguna
        $ids = [];
        if ($user->role === 'USER') {
            if ($request->filled('investor_ids')) {
                $ids = explode(',', $request->input('investor_ids'));
            } else if ($request->filled('people_ids')) {
                $ids = explode(',', $request->input('people_ids'));
            }
        } else if ($user->role === 'INVESTOR') {
            if ($request->filled('company_ids')) {
                $ids = explode(',', $request->input('company_ids'));
            } else if ($request->filled('people_ids')) {
                $ids = explode(',', $request->input('people_ids'));
            }
        } else if ($user->role === 'PEOPLE') {
            if ($request->filled('people_ids')) {
                $ids = explode(',', $request->input('people_ids'));
            } else if ($request->filled('company_ids')) {
                $ids = explode(',', $request->input('company_ids'));
            } else if ($request->filled('investor_ids')) {
                $ids = explode(',', $request->input('investor_ids'));
            }
        }

        // Simpan setiap ID ke wishlist
        foreach ($ids as $id) {
            // Pastikan ID tidak kosong
            if (!empty($id)) {
                // Validasi ID sebelum menyimpan
                $isValidId = false;

                if ($user->role === 'USER') {
                    $isValidId = Investor::where('id', $id)->exists() || People::where('id', $id)->exists();
                } else if ($user->role === 'INVESTOR') {
                    $isValidId = Company::where('id', $id)->exists() || People::where('id', $id)->exists();
                } else if ($user->role === 'PEOPLE') {
                    $isValidId = Investor::where('id', $id)->exists() || Company::where('id', $id)->exists() || People::where('id', $id)->exists();
                }

                if (!$isValidId) {
                    return redirect()->back()->with('error', 'Invalid ID: ' . $id);
                }

                $existingWishlist = null;

                // Cek apakah wishlist sudah ada
                if ($user->role === 'USER') {
                    $existingWishlist = Wishlist::where('user_id', $user->id)
                        ->where(function ($query) use ($id) {
                            $query->where('investor_id', $id)
                                ->orWhere('people_id', $id);
                        })->first();
                } else if ($user->role === 'INVESTOR') {
                    $existingWishlist = Wishlist::where('user_id', $user->id)
                        ->where(function ($query) use ($id) {
                            $query->where('company_id', $id)
                                ->orWhere('people_id', $id);
                        })->first();
                } else if ($user->role === 'PEOPLE') {
                    $existingWishlist = Wishlist::where('user_id', $user->id)
                        ->where(function ($query) use ($id) {
                            $query->where('investor_id', $id)
                                ->orWhere('company_id', $id)
                                ->orWhere('people_id', $id);
                        })->first();
                }

                // Jika belum ada, tambahkan ke wishlist
                if (!$existingWishlist) {
                    $data = [
                        'user_id' => $user->id,
                    ];

                    if ($user->role === 'USER') {
                        if ($request->filled('investor_ids') && in_array($id, explode(',', $request->input('investor_ids')))) {
                            $data['investor_id'] = $id;
                        } else {
                            $data['people_id'] = $id; // Menyimpan ID people
                        }
                    } else if ($user->role === 'INVESTOR') {
                        if ($request->filled('company_ids') && in_array($id, explode(',', $request->input('company_ids')))) {
                            $data['company_id'] = $id;
                        } else {
                            $data['people_id'] = $id; // Menyimpan ID people
                        }
                    } else if ($user->role === 'PEOPLE') {
                        if ($request->filled('investor_ids') && in_array($id, explode(',', $request->input('investor_ids')))) {
                            $data['investor_id'] = $id;
                        } else if ($request->filled('company_ids') && in_array($id, explode(',', $request->input('company_ids')))) {
                            $data['company_id'] = $id;
                        } else {
                            $data['people_id'] = $id; // Menyimpan ID people
                        }
                    }

                    Wishlist::create($data);
                }
            }
        }

        return redirect()->back()->with('success', 'Items added to wishlist.');
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
            // Melakukan pengecekan terlebih dahulu apakah investor_ids atau people_ids ada di dalam request
            if ($request->filled('investor_ids')) {
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
            }
            if ($request->filled('people_ids')) {
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
            } else {
                return redirect()->back()->with('error', 'No items to remove from wishlist.');
            }
        } else if ($user->role === 'INVESTOR') {
            // Check if company_ids or people_ids are in the request
            if ($request->filled('company_ids')) {
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
            }
            if ($request->filled('people_ids')) {
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
            } else {
                return redirect()->back()->with('error', 'No items to remove from wishlist.');
            }
        } else if ($user->role === 'PEOPLE') {
            // Check if company_ids, investor_ids, or people_ids are in the request
            if ($request->filled('company_ids')) {
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
            }

            // Ambil investor IDs dari form
            if ($request->filled('investor_ids')) {
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
            }

            if ($request->filled('people_ids')) {
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
            } else {
                return redirect()->back()->with('error', 'No items to remove from wishlist.');
            }
        }

        return redirect()->back()->with('success', 'Items removed from wishlist.');
    }
}
