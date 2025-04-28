<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\ViewLoggerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ViewLoggerTrait;
    
    public function account() {
        $user = User::findOrFail(Auth::id());
        $orders = Order::where('user_id', Auth::id())->orWhere('email', Auth::user()->email)->orderBy('id', 'desc')->get();

        $this->storeViewData('account', 'page');

        return view('pages.account', compact('user', 'orders'));
    }

    public function update(Request $request) {
        $user = User::findOrFail(Auth::id());
        
        $data = [];
    
        $data["name"] = $request->input('name') ?? $user->name;
        $data["phone"] = $request->input('phone') ?? $user->phone;
        $data["email"] = $request->input('email') ?? $user->email;
        $data["city"] = $request->input('city') ?? $user->city;
        $data["country"] = $request->input('country') ?? $user->country;
        $data["zip"] = $request->input('zip') ?? $user->zip;
        $data["description"] = $request->input('description') ?? $user->description;
        $data["image"] = $user->image; // Keep the existing image by default

        if($request->file('image')) {
            $data['image'] = $request->file('image')->store('profile', 'public');
    
            if($user->image) {
                Storage::disk('public')->delete($user->image);
            }
        }
    
        $user->update($data);
    
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function password() {
        return view('pages.password');
    }

    public function update_pass(Request $request) {
        $request->validate([
            'old-password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        if(!password_verify($request->input('old-password'), $user->password)) {
            return redirect()->back()->withErrors(['old-password' => 'Old password is incorrect']);
        }

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);

        if($request->input('source') === 'client') {
            return redirect('/account')->with('success', 'Password updated successfully');
        }
        return redirect()->back()->with('success', 'Password updated successfully');
    }
}
