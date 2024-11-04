<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Ambil jumlah baris dari permintaan, default ke 10 jika tidak ada
        $rowsPerPage = $request->input('rows', 10);

        // Ambil pengguna yang sedang login beserta wishlists mereka
        $user = User::with('wishlists.company.incomes')->find(Auth::id());

        // Ambil ID perusahaan dari wishlists pengguna
        $companyIds = $user->wishlists->pluck('company_id');

        // Ambil perusahaan dengan pendapatan berdasarkan ID perusahaan yang diambil dan paginate hasilnya
        $companiesWithWishlist = Company::with('incomes')
            ->whereIn('id', $companyIds)
            ->paginate($rowsPerPage); // Gunakan jumlah yang dipilih untuk pagination

        // Atur field tambahan untuk perusahaan
        $companiesWithWishlist->each(function ($company) {
            $latestIncome = $company->incomes->first();
            $company->latest_income_date = $latestIncome ? $latestIncome->date : null;
            $company->latest_funding_type = $latestIncome ? $latestIncome->funding_type : null;
        });

        return view('profile.profile', compact('user', 'companiesWithWishlist'));
    }


    public function show($id)
    {
        $user = User::find($id);
        $company = Company::where('user_id', $id)->first();

        return view('imm.profile-company', [
            'user' => $user,
            'company' => $company,
        ]);
    }

    public function editCompanyProfile()
    {
        $user = Auth::user();
        $company = $user->companies; // Ambil perusahaan yang relevan

        if (!$company) {
            return redirect('/imm');
        }

        // Ambil anggota tim dari company, lalu ambil department melalui position
        $team = $company->teamMembers()->get();

        // Ambil semua departemen
        $departments = Department::all();
        $selectedDepartments = $company->departments;

        // Mengambil nama departemen berdasarkan posisi dari tabel 'team'
        foreach ($team as $member) {
            // Ambil ID dari posisi yang tersimpan di pivot 'team'
            $positionId = $member->pivot->position;

            // Cari departemen berdasarkan ID posisi
            $department = Department::find($positionId);

            // Jika departemen ditemukan, set nama departemennya
            $member->departmentName = $department ? $department->name : 'No department assigned';
        }

        return view('imm.profile-company', compact('company', 'user', 'team', 'departments', 'selectedDepartments'));
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
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:10000',
            'nama' => 'required|string|max:255',
            'profile' => 'required|string|max:255',
            'founded_date' => 'required|date',
            'nama_pic' => 'required|string|max:255',
            'posisi_pic' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'jumlah_karyawan' => 'required|integer',
            'funding_stage' => 'required|string|max:255',
            'business_model' => 'required|string|max:255',
            'department_ids' => 'array',
            'startup_summary' => 'required|string',
        ]);

        $company = Company::findOrFail($id);

        $company->update([
            'nama' => $request->input('nama'),
            'profile' => $request->input('profile'),
            'founded_date' => $request->input('founded_date'),
            'nama_pic' => $request->input('nama_pic'),
            'posisi_pic' => $request->input('posisi_pic'),
            'telepon' => $request->input('telepon'),
            'negara' => $request->input('negara'),
            'provinsi' => $request->input('provinsi'),
            'kabupaten' => $request->input('kabupaten'),
            'jumlah_karyawan' => $request->input('jumlah_karyawan'),
            'funding_stage' => $request->input('funding_stage'),
            'business_model' => $request->input('business_model'),
            'startup_summary' => $request->input('startup_summary'),
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $path = $image->storeAs('public/company', $imageName);
            $company->image = Storage::url($path); // Simpan URL gambar
            $company->save();
        }

        if ($request->has('department_ids')) {
            $company->departments()->sync($request->input('department_ids'));
        }

        return redirect()->route('profile-company')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

    public function addTeamMember() {}
}
