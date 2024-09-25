<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Investor;
use App\Models\People;
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
        return view('auth.register');
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

        return redirect($this->redirectTo)->with('success', 'Registrasi berhasil! Silakan login.');
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
                'org_name' => ['required', 'string', 'max:255'],
                'number_of_contacts' => 'required|integer|min:0',
                'number_of_investments' => 'required|integer|min:0',
                'location' => 'required|string|max:255',
                'description' => 'required|string',
                'departments' => 'required|string|max:255',
            ]);
        } elseif ($role === 'PEOPLE') {
            $rules = array_merge($rules, [
                'name' => 'required|string|max:255',
                'primary_job_title' => 'required|string|max:255',
                'primary_organization' => 'required|string|max:255',
                'people_role' => 'required|in:Mentor,Pekerja,Konsultan',
                'people_phone' => 'required|string|max:15',
                'people_gmail' => 'required|email|max:255',
                'people_location' => 'required|string|max:255',
                'people_regions' => ['required', 'string', 'max:255'],
                'gender' => 'required|in:Laki-laki,Perempuan',
                'linkedin_link' => 'nullable|url',
                'people_description' => 'nullable|string',
            ]);
        }

        return Validator::make($data, $rules);
    }

    // Membuat instance user baru setelah validasi berhasil
    protected function create(array $data)
    {
        Log::info('Membuat user baru dengan email: ' . $data['email']);

        $user = User::create([
            'nama_depan' => $data['nama_depan'],
            'nama_belakang' => $data['nama_belakang'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        Log::info('User berhasil dibuat dengan ID: ' . $user->id);
        return $user;
    }

    // Membuat entri Investor setelah user dengan role INVESTOR dibuat
    protected function createInvestor(User $user, array $data)
    {
        Log::info('Membuat investor untuk user ID: ' . $user->id);

        Investor::create([
            'org_name' => $data['org_name'],
            'number_of_contacts' => $data['number_of_contacts'],
            'number_of_investments' => $data['number_of_investments'],
            'location' => $data['location'],
            'description' => $data['description'],
            'departments' => $data['departments'],
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
        'name' => $data['nama_depan'] . ' ' . $data['nama_belakang'],
        'primary_job_title' => $data['primary_job_title'],
        'primary_organization' => $data['primary_organization'],
        'role' => $data['people_role'],
        'phone_number' => $data['people_phone'],
        'gmail' => $data['people_gmail'],
        'location' => $data['people_location'],
        'regions' => $data['people_regions'],
        'gender' => $data['gender'],
        'linkedin_link' => $data['linkedin_link'],
        'description' => $data['people_description'],
    ]);

    Log::info('People berhasil dibuat untuk user ID: ' . $user->id);
}

}
