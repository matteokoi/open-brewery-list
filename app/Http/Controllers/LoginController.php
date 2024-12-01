<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $username = User::secureInput($request->username);
        $password = User::secureInput($request->password);
        $user = \App\Models\User::where('username', $username)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            $request->session()->regenerate(); // Prevent session fixation attacks
            return redirect()->action([BreweryController::class, 'index']);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->action([BreweryController::class, 'index'], ['token' => $token]);

    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
}
