<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->redirectTo = $this->determineRedirectPath();
    }

    /**
     * Determine the redirect path based on the user's role.
     *
     * @return string
     */
    protected function determineRedirectPath()
    {
        $user = auth()->user(); // Get the authenticated user

        // Check the role and determine the redirect path
        if ($user->role === 'INVESTOR') {
            return '/companies/company-list';
        } elseif ($user->role === 'PEOPLE') {
            return '/people/index';
        } elseif ($user->role === 'USER') {
            return RouteServiceProvider::HOME;
        }

        // Default redirect path
        return RouteServiceProvider::HOME;
    }
}
