<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{


    public function __construct(protected AuthService $authService)
    {}

    public function LoginPage()
    {
        return view('auth.login');
    }

    public function RegisterPage()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        if($this->authService->register($data))
        {
            return redirect()->route('homePage');
        }
        return redirect()->back()->withErrors(['email' => 'Wrong email, name or password']);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if ($this->authService->login($data))
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
