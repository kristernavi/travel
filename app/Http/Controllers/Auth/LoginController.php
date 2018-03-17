<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user)
    {
        if ('admin' == $user->type) {
            return redirect('/admin/home');
        } else {
            if (!$user->actived) {
                \Auth::logout();

                return redirect()->back()->withInput()->withInactive('Please wait until we verify your account. We active it as soon as possible. Thank');
            }

            return redirect('/business/home');
        }
    }

    public function showLoginForm()
    {
        return view('login');
    }
}
