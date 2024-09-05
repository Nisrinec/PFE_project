<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\HomeController;


class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth');
    }

    public function register(Request $request)
    {
       $request->validate( [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withInput()->withErrors(['email_exist' => 'Email address already exists.']);
        }

        $user = new User();
        $user->name = $request->name;
            $user->phone = $request->phone;
            $user-> email = $request->email;
            $user-> password = Hash::make($request->password);
            $user->save();
    return redirect()->route('home')->with('success', 'Registration successful.');
    }
     
    public function showLoginForm()
    {
        return view('auth');
    }

    public function login(Request $request)
    {
        $request->validate( [
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only( "email", "password");
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home')); 
        }
        return back()->withErrors([
            'incorrect-info' => 'Incorrect Email Or Password',
        ]); 
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}