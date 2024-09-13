<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login'; // Redirect to login page after registration

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration form submission
    protected function register(Request $request)
    {
        try {
            $this->validator($request->all())->validate();

            // Attempt to create the user
            $user = $this->create($request->all());

            // Redirect to the login page after registration
            return redirect($this->redirectTo)->with('success', 'Registration successful! Please login.');
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    // Validate registration form data
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $value)->first();
                    if ($user && !is_null($user->nik) && !is_null($user->negara) && !is_null($user->provinsi)) {
                        $fail('The email has already been taken by a complete profile.');
                    }
                },
            ],
            'password' => ['required', 'string', 'confirmed', 'min:8'], // Add a minimum length for password
            'nik' => ['required', 'digits:16', 'unique:users,nik,NULL,id,email,NULL,negara,NULL,provinsi,NULL'], // Ensure NIK is unique
            'negara' => ['required', 'string', 'max:50'],
            'provinsi' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:15'], // Adjusted the max length for phone number
        ]);
    }

    // Create a new user instance after a valid registration
    protected function create(array $data)
    {
        $user = User::firstOrNew(['email' => $data['email']]);

        $user->fill([
            'nama_depan' => $data['nama'],
            'password' => $data['password'],
            'nik' => $data['nik'],
            'negara' => $data['negara'],
            'provinsi' => $data['provinsi'],
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon'],
            'role' => 'USER',
        ]);

        $user->save();

        return $user;
    }
}
