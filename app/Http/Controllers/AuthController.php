<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



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
            'role_id' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withInput()->withErrors(['email_exist' => 'Email address already exists.']);
        }

        $user = new User();
        $user->name = $request->name;
            $user->phone = $request->phone;
            $user->role_id = $request->role_id;
            $user-> email = $request->email;
            $user-> password = Hash::make($request->password);
            $user->save();
            return view('auth');
    }
     
    public function showLoginForm()
    {
        return view('auth');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    // Check for the admin credentials directly
    if ($request->email === 'admin@gmail.com' && $request->password === '2024') {
        $admin = User::where('email', 'admin@gmail.com')->first();
        if ($admin) {
            Auth::login($admin);
            return redirect('/admin');
        }
    }

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->role_id == 1) {
            return redirect('/home');
        } elseif ($user->role_id == 2) {
            return redirect('/home');
        }
        return redirect('/dashboard');
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













// class AuthController extends Controller
// {
//     // Show registration form
//     public function showRegistrationForm()
//     {
//         return view('auth'); // Adjust the view name as needed
//     }

//     // Handle user registration
//     public function register(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'phone' => 'required|string|max:15',
//             'role_id' => 'required|in:1,2', // Ensure role_id is either '1' or '2'
//             'email' => 'required|email|unique:users,email',
//             'password' => 'required|string|min:8|confirmed', // Add password confirmation validation
//         ]);


//         $user = User::create([
//             'name' => $request->name,
//             'phone' => $request->phone,
//             'role_id' => $request->role_id,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//         ]);

//         Auth::login($user); // Automatically log in the user after registration

//         return redirect()->route('home')->with('success', 'Registration successful.');
//     }

//     // Show login form
//     public function showLoginForm()
//     {
//         return view('auth'); // Adjust the view name as needed
//     }

//     // Handle user login
//     public function login(Request $request)
//     {

//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);
//         dd("dwdw");

//         $credentials = $request->only('email', 'password');
//         if (Auth::attempt($credentials)) {
//             $user = Auth::user();
//             if ($user->role_id == '1') {
//                 return redirect()->route('home');
//             } else {
//                 return redirect()->route('default'); // Redirect to default route if needed
//             }
//         }

//         return back()->withErrors([
//             'incorrect-info' => 'Incorrect Email or Password',
//         ]);
//     }

//     // Handle user logout
//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
//         return redirect('/');
//     }
// }
