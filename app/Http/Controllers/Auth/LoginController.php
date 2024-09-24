<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
{
    $credentials = $this->credentials($request);
    $user = \App\Models\User::where('email', $credentials['email'])->first();
    Log::info('Attempting login with credentials: ', $credentials);
    Log::info('Attempting login for email: ' . $credentials['email']);
    Log::info('User found with role: ' . ($user ? $user->role : 'User not found'));

    if ($user) {
        // Cek apakah password cocok dengan hash di database
        if (Hash::check($credentials['password'], $user->password)) {
            Log::info('Password is valid for user: ' . $user->email);
        } else {
            Log::error('Password is invalid for user: ' . $user->email);
            return false; // Jika password salah, hentikan login
        }
    }

    if ($user && $user->role === 'USER') {
        if (is_null($user->nik) || is_null($user->negara) || is_null($user->provinsi)) {
            Log::error('Profile incomplete for USER');
            return false;
        }
    }

    if ($user && in_array($user->role, ['INVESTOR', 'PEOPLE'])) {
        if (is_null($user->email)) {
            Log::error('Invalid email for INVESTOR/PEOPLE');
            return false;
        }
    }

    // Panggil Auth::attempt setelah pengecekan role dan kondisi lain
    if (Auth::attempt($credentials, $request->filled('remember'))) {
        Log::info('Login successful for user: ' . Auth::user()->email);
        return true;
    } else {
        Log::error('Login failed for email: ' . $credentials['email']);
        return false;
    }
    if (Auth::guard('investor')->attempt($credentials, $request->filled('remember'))) {
        Log::info('Login successful for investor: ' . Auth::user()->email);
        return true;
    }
    
}

    /**
     * Redirect based on the user role after login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
{
    Log::info('Redirecting user after login: ' . $user->role);

    if ($user->role === 'INVESTOR') {
        Log::info('Redirecting to investor home');
        return redirect()->route('investor.home');
    } elseif ($user->role === 'PEOPLE') {
        return redirect()->route('people.home');
    }

    return redirect()->route('home'); // Redirect default
}



    /**
     * Custom failed login response for user with missing fields (only for 'USER' role).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && $user->role === 'USER' && (is_null($user->nik) || is_null($user->negara) || is_null($user->provinsi))) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([$this->username() => 'These credentials do not match our records.'])
                ->with('error', 'Please complete your profile with required information.');
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([$this->username() => trans('auth.failed')]);
    }
}
