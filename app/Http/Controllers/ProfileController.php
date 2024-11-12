<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\People;
use App\Models\Company;
use App\Models\Investor;
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
        $user = User::with('wishlists')->find(Auth::id());

        $userRole = $user->role;

        if($userRole === 'USER') {
            // Ambil ID investor dari wishlists pengguna
            $investorIds = $user->wishlists->pluck('investor_id');

            // Ambil ID People dari wishlists pengguna
            $peopleIds = $user->wishlists->pluck('people_id');

            // Buat query untuk mengambil investor berdasarkan ID yang ada di wishlist
            $query = Investor::whereIn('id', $investorIds);

            // Buat query untuk mengambil people berdasarkan ID yang ada di wishlist
            $people = People::whereIn('id', $peopleIds)->with('company','experiences')->paginate($rowsPerPage);

            // Nambah buat people last experience
            foreach ($people as $person) {
                $latestExperience = $person->experiences->sortByDesc('end_date')->first();

                // Cek apakah $latestExperience ada
                if ($latestExperience) {
                    $person->pengalaman = $latestExperience->position;
                } else {
                    $person->pengalaman = 'N/A'; // Jika tidak ada pengalaman, set ke 'N/A'
                }
            }

            // Paginate the results
            $investors = $query->paginate($rowsPerPage);

            return view('profile.profile', compact('user', 'investors', 'people', 'userRole'));
        } else if ($userRole === 'PEOPLE') {
            // Ambil ID perusahaan dari wishlists pengguna
            $companyIds = $user->wishlists->pluck('company_id');

            // Ambil perusahaan dengan data yang diperlukan
            $companies = Company::with('departments', 'fundingRounds')->whereIn('id', $companyIds)->paginate($rowsPerPage);

            // Tambahkan informasi tambahan ke setiap perusahaan
            foreach ($companies as $company) {
                $company->all_departments = $company->departments->pluck('name');
                $company->departments = $company->departments->take(2)->pluck('name');
                $company->latest_funding_date = $company->fundingRounds->max('announced_date');
            }

            $investor = $user->investor;

            // Ambil ID investor dari wishlists pengguna
            $investorIds = $user->wishlists->pluck('investor_id');

            // Ambil ID People dari wishlists pengguna
            $peopleIds = $user->wishlists->pluck('people_id');

            // Buat query untuk mengambil investor berdasarkan ID yang ada di wishlist
            $query = Investor::whereIn('id', $investorIds);

            // Buat query untuk mengambil people berdasarkan ID yang ada di wishlist
            $people = People::whereIn('id', $peopleIds)->with('company','experiences')->paginate($rowsPerPage);

            // Nambah buat people last experience
            foreach ($people as $person) {
                $latestExperience = $person->experiences->sortByDesc('end_date')->first();

                // Cek apakah $latestExperience ada
                if ($latestExperience) {
                    $person->pengalaman = $latestExperience->position;
                } else {
                    $person->pengalaman = 'N/A'; // Jika tidak ada pengalaman, set ke 'N/A'
                }
            }

            // Paginate the results
            $investors = $query->paginate($rowsPerPage);

            return view('profile.profile', compact('user', 'companies', 'userRole', 'people', 'investors'));
        } else if ($userRole === 'INVESTOR') {
            // Ambil ID perusahaan dari wishlists pengguna
            $companyIds = $user->wishlists->pluck('company_id');

            $investor = $user->investor;

            // Ambil perusahaan dengan data yang diperlukan
            $companies = Company::with('departments', 'fundingRounds')
                ->whereIn('id', $companyIds)
                ->paginate($rowsPerPage);

            // Tambahkan informasi tambahan ke setiap perusahaan
            foreach ($companies as $company) {
                $company->all_departments = $company->departments->pluck('name');
                $company->departments = $company->departments->take(2)->pluck('name');
                $company->latest_funding_date = $company->fundingRounds->max('announced_date');
            }

            // Ambil ID People dari wishlists pengguna
            $peopleIds = $user->wishlists->pluck('people_id');

            // Buat query untuk mengambil people berdasarkan ID yang ada di wishlist
            $people = People::whereIn('id', $peopleIds)->with('company','experiences')->paginate($rowsPerPage);

            // Nambah buat people last experience
            foreach ($people as $person) {
                $latestExperience = $person->experiences->sortByDesc('end_date')->first();

                // Cek apakah $latestExperience ada
                if ($latestExperience) {
                    $person->pengalaman = $latestExperience->position;
                } else {
                    $person->pengalaman = 'N/A'; // Jika tidak ada pengalaman, set ke 'N/A'
                }
            }

            return view('profile.profile', compact('user', 'companies', 'userRole', 'investor', 'people'));
        }

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

    public function editCompanyProfile(Request $request)
    {
        $user = Auth::user();
        $company = $user->companies; // Ambil perusahaan yang relevan
        $rowsPerPage = $request->input('rows', 10);

        if (!$company) {
            return redirect('/imm');
        }

        // Ambil anggota tim dari company dengan paginasi
        $team = $company->teamMembers()->paginate($rowsPerPage);

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
        $userRole = $user->role;
        if ($userRole === 'INVESTOR') {
            $investor = $user->investor;
            $companies = Company::all();
            // Mengambil data departments untuk digunakan pada view
            $departments = Department::all();
            $selectedDepartments = $investor->departments;
            return view('profile.edit', compact('user', 'investor', 'userRole', 'companies', 'departments', 'selectedDepartments'));
        }
        return view('profile.edit', compact('user',  'userRole'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'img' => 'image|mimes:jpeg,png,jpg,webp|max:10000' // Validasi untuk gambar
        ]);

        $user = User::findOrFail(Auth::user()->id);

        // Split nama_depan menjadi nama depan dan nama belakang
        $namaDepanBelakang = explode(' ', $request->input('nama_depan'), 2);
        $user->nama_depan = $namaDepanBelakang[0]; // Nama depan
        $user->nama_belakang = isset($namaDepanBelakang[1]) ? $namaDepanBelakang[1] : ''; // Nama belakang, jika ada

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

        if ($user->role === 'INVESTOR') {
           // Validasi data yang diterima dari request
            $validatedData = $request->validate([
                'org_name' => 'nullable|exists:companies,id',
                'number_of_contacts' => 'nullable|integer',
                'description' => 'required|string',
                'investment_stage' => 'required|string',
                'investor_type' => 'nullable|string',
                'tag_ids' => 'array',
                'tag_ids.*' => 'exists:departments,id', // Pastikan tag_ids valid
            ]);

            // Mencari investor berdasarkan ID
            $investor = Investor::where('user_id', $user->id)->first();

            // Mengupdate atribut investor
            $companyName = null;
            if ($validatedData['org_name']) {
                $company = Company::find($validatedData['org_name']);
                $companyName = $company ? $company->nama : null;
            }

            $investor->org_name = $companyName; // Simpan nama perusahaan, bukan ID
            $investor->number_of_contacts = $validatedData['number_of_contacts'] ?? null; // Bisa nullable
            $investor->description = $validatedData['description'];
            $investor->investment_stage = $validatedData['investment_stage']; // Simpan investment_stage
            $investor->investor_type = $validatedData['investor_type'] ?? null; // Bisa nullable
            $investor->user_id = $user->id; // Pastikan user_id tetap sama

            // Simpan perubahan
            $investor->save();

            // Mengupdate departments yang terhubung dengan investor
            if (isset($validatedData['tag_ids'])) {
                $investor->departments()->sync($validatedData['tag_ids']); // Mengupdate hubungan
            }
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }


    public function updateCompanyProfile(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:102400',
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
            $imageName = $image->getClientOriginalName(); // Mengambil nama asli file
            $folderName = strtolower(str_replace(' ', '_', $company->nama)); // Membuat nama folder dari nama perusahaan
            $path = $image->storeAs("public/$folderName", $imageName); // Menyimpan dengan nama asli di folder baru
            $company->image = Storage::url($path); // Simpan URL gambar
            $company->save();
        }

        if ($request->has('department_ids')) {
            $company->departments()->sync($request->input('department_ids'));
        }

        return redirect()->route('profile-company')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

}
