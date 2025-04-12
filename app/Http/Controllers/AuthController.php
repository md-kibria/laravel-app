<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ViewLoggerTrait;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ViewLoggerTrait;

    public function signup() {
        $this->storeViewData('signup', 'page');
        session()->put('previousUrl', session()->get('previousUrl') ?? url()->previous());

        $site_settings = SiteSetting::first();
        $keywords = $site_settings->keywords;
        $datePublished = $site_settings->created_at->format('Y-m-d\TH:i:sP');

        return view('pages.auth.signup', compact('keywords', 'datePublished'));
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        // Total users
        $totalUsers = User::count();

        // If no user exists, make the first user an admin
        $role = 'user';
        if ($totalUsers === 0) {
            $role = 'super';
        } else {
            $role = 'user';
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        Auth::login($user);

        $previousUrl = session()->get('previousUrl');
        if($previousUrl) {
            session()->forget('previousUrl'); // Clean up session
            return redirect($previousUrl)->with('success', 'Account created successfully');
        }
        
        return redirect('/account')->with('success', 'Account created successfully');;
    }

    public function login() {
        $this->storeViewData('login', 'page');
        session()->put('previousUrl', url()->previous());

        $site_settings = SiteSetting::first();
        $keywords = $site_settings->keywords;
        $datePublished = $site_settings->created_at->format('Y-m-d\TH:i:sP');

        return view('pages.auth.login', compact('keywords', 'datePublished'));
    }

    public function auth(Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {

            $previousUrl = session()->get('previousUrl');
            if($previousUrl) {
                session()->forget('previousUrl'); // Clean up session
                return redirect($previousUrl)->with('message', 'Successfully logged in');
            }

            return redirect('/account')->with('message', 'Successfully logged in');
        }

        return back()->withErrors(['email' => 'Invalid credentials', 'password' => 'Invalid credentials']);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
