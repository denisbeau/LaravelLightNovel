<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    // Default redirect will be decided dynamically in redirectTo()
    protected $redirectTo = '/home';

    /**
     * Get the post-login redirect path depending on user role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();
        if ($user && $user->role === User::ADMIN_ROLE) {
            // Redirect admins to admin dashboard
            return route('admin.dashboard');
        }

        // Regular users
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
