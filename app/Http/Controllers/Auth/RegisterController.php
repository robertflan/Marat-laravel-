<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerify;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'gender' => 'required|in:Herr,Frau',
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            //'password' => 'required|string|alpha_num|min:8|regex:/^([0-9]+[a-zA-Z]+|[a-zA-Z]+[0-9]+)[0-9a-zA-Z]*$/',
            'password' => 'required|string|alpha_num|min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $activation_code = str_random(30);

        $user = new User;
        $user->company_id = env('APP_COMPANY', 1);
        $user->gender = $data['gender'];
        $user->last_name = $data['last_name'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->activation_code = $activation_code;
        $user->save();

        $user->roles()->attach(3);

        Mail::to($user)->send(new EmailVerify($user));

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->with('status', 'Please click on the activation link in the email');
    }

    /**
     * Activate user via email.
     *
     * @param string $activation_code
     * @return \Illuminate\Http\Response
     */
    public function activate($activation_code)
    {
        if(!$activation_code)
        {
            throw new InvalidActivationCodeException;
        }

        $user = User::whereActivationCode($activation_code)->first();

        if (!$user)
        {
            throw new InvalidActivationCodeException;
        }

        $user->activated = 1;
        $user->activation_code = null;
        $user->save();

        // $this->guard()->login($user);

        Auth::login($user);

        return redirect('/my/profile')->with('status', 'You have successfully verified your account.');
    }
}
