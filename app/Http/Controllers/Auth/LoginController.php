<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/my/profile';

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
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        if($request->redirect_path) {
            session(['redirect_path' => $request->redirect_path]);
        }

        return view('auth.login');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        // add check for company here
        $this->clearLoginAttempts($request);

        if (strpos($request->headers->get('referer'), '/dashboard/login') !== false) {
            $redirect_path = '/dashboard/';
        } elseif(session('redirect_path')) {
            $redirect_path = session('redirect_path');
        } else {
            $redirect_path = $this->redirectPath();
        }

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($redirect_path);
    }
}
