<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function showregister()
    {

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:5'],
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed', 'min:8']
            ]
        );

        $roleData = User::count();

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $roleData === 0 ? 'admin' : 'user';

        $user->save();

        return redirect('/')->with('success', "Berhasil Register");
    }

    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/welcome')->with('success', "Berhasil Login");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('error', "Berhasil Logout");
    }

    // public function getProfile()
    // {

    //     $userAuth = Auth::User()->profile;

    //     $userId = Auth::id();

    //     $profileData = Profile::where('user_id', $userId)->first();

    //     if ($userAuth) {
    //         return view("profile.edit",  ["profile" => $profileData]);
    //     } else {
    //         return view("profile.create");
    //     }
    // }

    // public function createProfile(Request $request)
    // {
    //     // dd($request->all());

    //     $request->validate(
    //         [
    //             'age' => ['required', 'numeric'],
    //             'address' => ['required', 'min:5'],
    //         ]
    //     );

    //     $userId = Auth::id();


    //     $profile = new Profile;
    //     $profile->age = $request->input('age');
    //     $profile->address = $request->input('address');
    //     $profile->user_id = $userId;

    //     $profile->save();

    //     return redirect('/profile')->with('success', "Berhasil Register");
    // }

    // public function updateProfile(Request $request, $id)
    // {
    //     // dd($request->all());

    //     $request->validate(
    //         [
    //             'age' => ['required', 'numeric'],
    //             'address' => ['required', 'min:5'],
    //         ]
    //     );


    //     $profile = Profile::find($id);
    //     $profile->age = $request->input('age');
    //     $profile->address = $request->input('address');

    //     $profile->save();

    //     return redirect('/profile')->with('success', "Berhasil Update");
    // }
}
