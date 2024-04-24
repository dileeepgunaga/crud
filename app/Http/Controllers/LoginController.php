<?php
// app/Http/Controllers/Auth/LoginController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
          //  return redirect()->intended('/');
          $user = Auth::user();
          return view('view',['user' => $user]);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
}
