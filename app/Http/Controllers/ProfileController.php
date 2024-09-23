<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $company = Company::where('user_id', $id)->first();

        return view('imm.profile-commpany', [
            'user' => $user,
            'company' => $company,
        ]);
    }

    public function editCompanyProfile()
    {
        $user = Auth::user();
        $company = $user->companies;
        $team = $company->teamMembers;
        $products = $company->products;

        if (!$company) {
            return redirect('/imm');
        }
    
        return view('imm.profile-commpany', compact('company', 'user', 'team', 'products'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'img' => 'image|mimes:jpeg,png,jpg,webp|max:10000' // Validasi untuk gambar
        ]);        
    
        $user = User::findOrFail(Auth::user()->id);
        $user->nama_depan = $request->input('nama_depan');
        $user->email = $request->input('email');
        $user->nik = $request->input('nik');
        $user->negara = $request->input('negara');
        $user->provinsi = $request->input('provinsi');
        $user->alamat = $request->input('alamat');
        $user->telepon = $request->input('telepon');
    
        // Proses gambar baru jika diunggah
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $user->img = $imageName;
        }

    
        $user->save();
    
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
    

    public function updateCompanyProfile(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'profile' => 'required|string|max:255',
            'founded_date' => 'required|date',
            'tipe' => 'required|string|max:255',
            'nama_pic' => 'required|string|max:255',
            'posisi_pic' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'jumlah_karyawan' => 'required|integer',
            'startup_summary' => 'required|string',
        ]);

        $company = Company::findOrFail($id);
        $company->update([
            'nama' => $request->input('nama'),
            'profile' => $request->input('profile'),
            'founded_date' => $request->input('founded_date'),
            'tipe' => $request->input('tipe'),
            'nama_pic' => $request->input('nama_pic'),
            'posisi_pic' => $request->input('posisi_pic'),
            'telepon' => $request->input('telepon'),
            'negara' => $request->input('negara'),
            'provinsi' => $request->input('provinsi'),
            'kabupaten' => $request->input('kabupaten'),
            'jumlah_karyawan' => $request->input('jumlah_karyawan'),
            'startup_summary' => $request->input('startup_summary'),
        ]);

        return redirect()->route('profile-commpany')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

}
