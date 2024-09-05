<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ProfilController extends Controller
{
    public function index()
    {
        return view('profil');
    }
    public function edit()
    {
        return view('edit', ['user' => Auth::user()]);
    }
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15', // Adjust validation rules as needed
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        
        // Update user information
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public', $filename);
            $user->picture = $filename;
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profile updated successfully.');
    }
    public function updatePassword(Request $request)
    {
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);


        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('profil')->with('success', 'Password updated successfully!');
    }
}