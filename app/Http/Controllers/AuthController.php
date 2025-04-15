<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ViewLoggerTrait;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\CssSelector\Node\FunctionNode;

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

    // Password reset
    public function resetPassword() {
        return view('pages.auth.reset-password');
    }

    public function resetPasswordEmail(Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found with this email.']);
        }

        
        $token = hash('sha256', Str::random(60));

        PasswordResetToken::create([
            'email' => $request->input('email'),
            'token' => $token,
        ]);

        // Send password reset email
        Mail::to($user->email)->send(new ResetPasswordMail($token, $user));
        

        return back()->with('success', 'Password reset link sent to your email.');
    }

    public function resetPasswordGet(Request $request) {
        $token = $request->query('token'); // Gets the token from query string
    
        // Verify token exists
        if (!$token) {
            return redirect()->route('password.reset')
                   ->with('error', 'Invalid password reset token');
        }

        // Check if the token is valid
        $passwordResetToken = PasswordResetToken::where('token', $token)->first();
        if (!$passwordResetToken) {
            return redirect()->route('password.reset')
                   ->with('error', 'Invalid password reset token');
        }
        // Check if the token is expired (optional, depending on your implementation)
        $isExpired = Carbon::now()->diffInHours($passwordResetToken->created_at) > 24; // Example: 24 hours expiration
        if ($isExpired) {
            return redirect()->route('password.reset')
                   ->with('error', 'Password reset token has expired');
        }
        
        return view('pages.auth.update-password', ['token' => $token]);
    }

    public function resetPasswordUpdate(Request $request) {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $token = $request->input('token');
        $passwordResetToken = PasswordResetToken::where('token', $token)->first();
        if (!$passwordResetToken) {
            return redirect()->route('password.reset')
                   ->with('error', 'Invalid password reset token');
        }
        $user = User::where('email', $passwordResetToken->email)->first();
        if (!$user) {
            return redirect()->route('password.reset')
                   ->with('error', 'User not found');
        }
        // Update the user's password
        $user->password = Hash::make($request->input('password'));
        $user->save();
        // Delete the password reset token
        $passwordResetToken->delete();
        // Optionally, you can log the user in after resetting the password
        Auth::login($user);
        return redirect('/account')->with('success', 'Password updated successfully');
    }
}
