<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function LoginPage()
    {
        return view('auth.login');
    }

    public function RegisterPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        if($this->authService->register($request))
        {
            return redirect()->route('homePage');
        }
        return redirect()->back()->withErrors(['email' => 'Wrong email, name or password']);
    }

    public function login(Request $request)
    {
        if ($this->authService->login($request))
        {
            return redirect()->route('homePage'); 
        }
        return redirect()->back()->withErrors(['email' => 'Wrong email or password']);
    }

    public function logout()
    {
        auth('web')->logout();
        return redirect()->route('loginPage');
    }
}
