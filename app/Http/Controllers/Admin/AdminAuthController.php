<?php
 namespace App\Http\Controllers\Admin;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 
 class AdminAuthController extends Controller
 {
     public function showLoginForm()
     {
         return view('admin.auth.login');
     }
 
     public function login(Request $request)
     {
         $credentials = $request->only('email', 'password');
 
         if (Auth::guard('admin')->attempt($credentials)) {
             return redirect()->intended('dashboard');
         }
 
         return redirect()->route('admin.login')->withErrors([
             'email' => 'The provided credentials do not match our records.',
         ]);
     }
 
     public function logout(Request $request)
     {
         Auth::guard('admin')->logout();
 
         // Invalidate the session and regenerate a new token
         $request->session()->invalidate();
         $request->session()->regenerateToken();
 
         return redirect()->route('admin.login');
     }
 }
 