<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $custom_error = [
            'email_signup.required'             => 'An email is required to have you onboard with us!',
            'email_signup.unique'               => 'It seems like this email has already been taken!',
            'passwordSignup.unique'            => 'A password is needed for your account!',
            'passwordSignup.confirmed'         => 'Oh dear, the passwords did not match! Let\'s try again shall we?',
            'passwordSignup_confirmation.required'    => 'Please input the password confirmation field so we know this is the right password!',
        ];
        
        return Validator::make($data, [
            'name'                              => ['required', 'string', 'max:255'],
            // 'description'                    => ['required'],
            'email_signup'                      => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'passwordSignup'                   => ['required', 'string', 'confirmed'],
            'passwordSignup_confirmation'      => ['required'],
        ], $custom_error);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'              => trim($data['name']),
            'description'       => "Oh no, your description is currently empty! Let's edit it together in \"Edit Details\"!",
            'email'             => trim($data['email_signup']),
            'password'          => Hash::make($data['passwordSignup']),
        ]);
    }
}
