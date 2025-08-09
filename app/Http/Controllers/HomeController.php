<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        return view('home', compact('posts'));
    }

    public function profile()
    {
        // Logic to show user profile
        return view('profile');
    }

    public function settings()
    {
        // Logic to show user settings
        return view('settings');
    }

    public function passwordUpdate(Request $request)
    {
        // Logic to update user password
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Update password logic here
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }
        $user->password = Hash::make($request->password);
        $user->save();

        // user logout 
        auth()->logout();

        return redirect()->route('login')->with('success', 'Password updated successfully!');
    }
}
