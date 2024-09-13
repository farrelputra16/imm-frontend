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
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

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

    // Check for user existence and complete profile ONLY for 'USER' role
    if ($user && $user->role === 'USER') {
        if (is_null($user->nik) || is_null($user->negara) || is_null($user->provinsi)) {
            return false;
        }
    }

    // Attempt login for all users, regardless of role
    $attempt = Auth::attempt($credentials, $request->filled('remember'));

    if ($attempt) {
        Log::info('Login attempt successful for user: ' . $user->email);
    } else {
        Log::info('Login attempt failed for user: ' . $credentials['email']);
    }

    return $attempt;
}


protected function authenticated(Request $request, $user)
{
    // Check if user has a company
    if ($user->companies) {
        return redirect()->route('homepage');
    }

    return redirect()->route('home');
}

protected function sendFailedLoginResponse(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && $user->role === 'USER') {
            if (is_null($user->nik) || is_null($user->negara) || is_null($user->provinsi)) {
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([
                        $this->username() => 'These credentials do not match our records.',
                    ])->with('error', 'These credentials do not match our records.');
            }
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => trans('auth.failed'),
            ])->with('error', trans('auth.failed'));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request)->with('success', 'Login successful!');
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

}
