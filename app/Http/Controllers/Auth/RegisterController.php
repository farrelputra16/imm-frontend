<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Investor;
use App\Models\People;
use App\Models\Company; // Tambahkan model Company
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        Log::info('Menampilkan form registrasi.');
        $companies = Company::all();
        return view('auth.register', compact('companies'));
    }

    // Proses registrasi
    protected function register(Request $request)
    {
        Log::info('Memulai proses registrasi untuk email: ' . $request->email);

        // Validasi input berdasarkan role
        $this->validator($request->all())->validate();
        Log::info('Validasi berhasil untuk email: ' . $request->email);

        // Membuat user berdasarkan input
        $user = $this->create($request->all());
        Log::info('User berhasil dibuat dengan ID: ' . $user->id . ' dan role: ' . $user->role);

        // Proses logika tambahan jika role Investor atau People
        if ($user->role === 'INVESTOR') {
            $this->createInvestor($user, $request->all());
            Log::info('Investor berhasil dibuat untuk user ID: ' . $user->id);
        } elseif ($user->role === 'PEOPLE') {
            $this->createPeople($user, $request->all());
            Log::info('People berhasil dibuat untuk user ID: ' . $user->id);
        }

        // Login otomatis setelah registrasi
        $this->guard()->login($user);
        Log::info('User berhasil login setelah registrasi dengan ID: ' . $user->id);

        // Redirect berdasarkan role
        if ($user->role === 'INVESTOR') {
            return redirect()->route('investor.home')->with('success', 'Registrasi berhasil!');
        } elseif ($user->role === 'PEOPLE') {
            return redirect()->route('people.home')->with('success', 'Registrasi berhasil!');
        }

        // Redirect default untuk role lain
        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }

    // Validasi input form registrasi berdasarkan role
    protected function validator(array $data)
    {
        $role = $data['role'] ?? 'USER'; // Default ke USER jika role tidak dipilih
        Log::info('Validasi untuk role: ' . $role);

        // Aturan validasi umum
        $rules = [
            'nama_depan' => ['required', 'string', 'max:255'],
            'nama_belakang' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ];

        // Tambahan aturan validasi berdasarkan role
        if ($role === 'USER') {
            $rules = array_merge($rules, [
                'nik' => ['required', 'digits:16', 'unique:users,nik'],
                'negara' => ['required', 'string', 'max:50'],
                'provinsi' => ['required', 'string', 'max:50'],
                'alamat' => ['required', 'string', 'max:255'],
                'telepon' => ['required', 'string', 'max:15'],
            ]);
        } elseif ($role === 'INVESTOR') {
            $rules = array_merge($rules, [
                'org_name' => ['nullable', 'exists:companies,id'], // Validasi ID perusahaan, bisa kosong
                'number_of_contacts' => 'nullable|integer|min:0',
                'location' => 'required|string|max:255',
                'description' => 'required|string',
                'departments' => 'required|string|max:255',
                'investment_stage' => 'required|string|max:255', // Validasi untuk investment_stage
            ]);
        } elseif ($role === 'PEOPLE') {
            // Hanya validasi kolom yang diperlukan, sisanya dibiarkan kosong
            $rules = array_merge($rules, [
                'name' => 'required|string|max:255',
                'people_role' => 'required|in:Mentor,Pekerja,Konsultan',
                'people_phone' => 'required|string|max:15',
                'people_gmail' => 'required|email|max:255',
                'gender' => 'required|in:Laki-laki,Perempuan',
            ]);
        }

        return Validator::make($data, $rules);
    }

    // Membuat instance user baru setelah validasi berhasil
    protected function create(array $data)
    {
        Log::info('Membuat user baru dengan email: ' . $data['email']);

        $userData = [
            'nama_depan' => $data['nama_depan'],
            'nama_belakang' => $data['nama_belakang'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ];

        // Tambahkan field tambahan untuk role USER
        if ($data['role'] === 'USER') {
            $userData['nik'] = $data['nik'];
            $userData['negara'] = $data['negara'];
            $userData['provinsi'] = $data['provinsi'];
            $userData['alamat'] = $data['alamat'];
            $userData['telepon'] = $data['telepon'];
        }

        $user = User::create($userData);

        Log::info('User berhasil dibuat dengan ID: ' . $user->id);
        return $user;
    }

    // Membuat entri Investor setelah user dengan role INVESTOR dibuat
    protected function createInvestor(User $user, array $data)
{
    Log::info('Membuat investor untuk user ID: ' . $user->id);

    // Ambil nama perusahaan dari tabel Company berdasarkan ID yang dipilih
    $companyName = null;
    if ($data['org_name']) {
        $company = Company::find($data['org_name']);
        $companyName = $company ? $company->nama : null;
    }

    Investor::create([
        'org_name' => $companyName, // Simpan nama perusahaan, bukan ID
        'number_of_contacts' => $data['number_of_contacts'] ?? null, // Bisa nullable
        'location' => $data['location'],
        'description' => $data['description'],
        'departments' => $data['departments'],
        'investment_stage' => $data['investment_stage'], // Simpan investment_stage
        'user_id' => $user->id, // Link ke user yang baru dibuat
    ]);

    Log::info('Investor berhasil dibuat untuk user ID: ' . $user->id);
}


    // Membuat entri People setelah user dengan role PEOPLE dibuat
    protected function createPeople(User $user, array $data)
    {
        Log::info('Membuat people untuk user ID: ' . $user->id);

        People::create([
            'user_id' => $user->id, // Associate user with people
            'name' => $data['nama_depan'] . ' ' . $data['nama_belakang'], // Gabungan nama depan dan belakang
            'role' => $data['people_role'], // Sub-role seperti Mentor, Pekerja, atau Konsultan
            'phone_number' => $data['people_phone'], // Nomor telepon
            'gmail' => $data['people_gmail'], // Gmail
            'gender' => $data['gender'], // Jenis kelamin
        ]);

        Log::info('People berhasil dibuat untuk user ID: ' . $user->id);
    }
}
