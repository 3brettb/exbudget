<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {   
        return view('auth.login');
    }

    public function create()
    {
        $this->validate(request(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'username' => 'required|min:4|unique:user',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'firstname' => request('firstname'),
            'lastname' => request('lastname'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'api_token' => str_random(60),
        ]);

        auth()->login($user);

        return redirect()->home();
    }

    public function authenticate()
    {
        if(! auth()->attempt(request(['email', 'password']))){
            $errors = array('password' => ['Email and/or password is invalid.']);
            return back()->withErrors($errors)->withInput(request()->except('password'));
        };
        
        auth()->user()->generate_user_token('api');

        return redirect()->home();
    }

    public function logout()
    {
        auth()->user()->revoke_user_token('api');

        auth()->logout();

        return redirect()->home();
    }
}