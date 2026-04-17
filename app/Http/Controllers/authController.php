<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class authController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('homepage'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            // 'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imagePath = 'users/default.jpg'; 

        // $imagePath = null;
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('users', 'public');
        // }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
        ]);

        
        $userRole = Roles::where('name', 'user')->first();
        $user->roles()->attach($userRole);
        // dd($user->id);

        Auth::login($user);
        return redirect('/login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function editProfile(){
        $user = Auth::user();
        return view('main.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request){
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            // 'password' => 'required|confirmed',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if ($request->filled('password')) {
            $request->validate(['password' => '|confirmed']);
            $data['password'] = Hash::make($request->password);
        }
        
        if ($request->hasFile('image')) {
            if ($user->image !== 'users/default.jpg'){
                Storage::disk('public')->delete($user->image);
            }

        $data['image'] = $request->file('image')->store('users', 'public');

        }

        $user->update($data);
        return redirect()->route('homepage')->with('success', 'udah diubah');

    }
}
