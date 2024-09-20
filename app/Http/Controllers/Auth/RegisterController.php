<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Investor;
use App\Models\People;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register'); // View includes role selection
    }

    // Handle registration form submission
    protected function register(Request $request)
    {
        // Validate the input based on role
        $this->validator($request->all())->validate();

        // Create the user based on the input
        $user = $this->create($request->all());

        // Handle post-registration logic for Investor or People roles
        if ($user->role === 'INVESTOR') {
            $this->createInvestor($user, $request->all());
        } elseif ($user->role === 'PEOPLE') {
            $this->createPeople($user, $request->all());
        }

        return redirect($this->redirectTo)->with('success', 'Registration successful! Please login.');
    }

    // Validate registration form data based on role
    protected function validator(array $data)
    {
        $role = $data['role'] ?? 'USER'; // Default to USER role if not specified

        // Common validation rules
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ];

        // Additional rules based on role
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
                'contact_number' => ['required', 'string', 'max:15'],
            ]);
        } elseif ($role === 'PEOPLE') {
            $rules = array_merge($rules, [
                'job_title' => ['required', 'string', 'max:255'],
                'primary_organization' => ['required', 'string', 'max:255'],
            ]);
        }

        return Validator::make($data, $rules);
    }

    // Create a new user instance after a valid registration
    protected function create(array $data)
    {
        return User::create([
            'nama_depan' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    // Create an Investor entry after a user with role INVESTOR is created
    protected function createInvestor(User $user, array $data)
    {
        Investor::create([
            'user_id' => $user->id,
            'org_name' => $data['org_name'],
            'number_of_contacts' => 0,
            'number_of_investments' => 0,
            'location' => $data['location'] ?? 'Unknown',
            'description' => $data['description'] ?? 'No description',
            'departments' => $data['departments'] ?? 'General',
        ]);
    }

    // Create a People entry after a user with role PEOPLE is created
    protected function createPeople(User $user, array $data)
    {
        People::create([
            'user_id' => $user->id,
            'name' => $data['nama'],
            'role' => $data['people_role'], // Mentor, Pekerja, Konsultan
            'primary_job_title' => $data['job_title'],
            'primary_organization' => $data['primary_organization'],
            'location' => $data['location'] ?? 'Unknown',
            'phone_number' => $data['telepon'],
            'gmail' => $data['email'],
        ]);
    }
}
