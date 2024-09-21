<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcomeMail;




class AdminController extends BaseController
{

        public function index()
        {
            // Get the currently authenticated admin user
            $admin = Auth::guard('admin')->user();

            // Return the view and share the admin data with the navbar view
            return view('backend.index')->with('admin', $admin);
        }
            

    // Handle admin login request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

             // Fetch the admin details
             $admin = Admin::where('email', $request->email)->first();
             // Store admin details in session or pass it to the view
             session(['admin' => $admin]);

             
            return redirect()->route('admin.dashboard');
        }

        $request->session()->flash('error', 'Invalid email or password.');
        return redirect()->back();
    }

    // Handle admin logout request
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Add a flash message for successful logout
        return redirect()->route('admin.login')->with('status', 'Logged out successfully!');
    }
}
