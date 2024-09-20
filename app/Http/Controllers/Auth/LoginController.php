<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        // Check for user existence and handle specific validation for 'USER' role
        if ($user && $user->role === 'USER') {
            if (is_null($user->nik) || is_null($user->negara) || is_null($user->provinsi)) {
                return false;
            }
        }

        // Attempt login for all users regardless of role
        return Auth::attempt($credentials, $request->filled('remember'));
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
        // Check the user role and redirect accordingly
        if ($user->role === 'INVESTOR') {
            return redirect()->route('companies.list'); // Customize this route
        } elseif ($user->role === 'PEOPLE') {
            return redirect()->route('people.index'); // Customize this route
        }

        return redirect()->route('home');
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
