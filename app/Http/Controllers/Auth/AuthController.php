<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'balance' => 99999.00,
        ]);
        Auth::login($user);
        return redirect()->route('products.index')->with('success', 'Регистрация успешна');
    }

    public function showLogin()
    {
        if (auth()->check()) {
            return redirect()->route('products.index');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('products.index'));
        }
        return back()->withErrors(['auth' => 'Неверный email или пароль']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('register');
    }
}
