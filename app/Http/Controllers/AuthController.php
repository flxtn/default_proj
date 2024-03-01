<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{


    public function __construct(protected AuthService $authService)
    {}

    public function LoginPage(): View
    {
        return view('auth.login');
    }

    public function RegisterPage(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if($this->authService->register($data))
        {
            return redirect()->route('homePage');
        }
        return redirect()->back()->withErrors(['email' => 'Wrong email, name or password']);
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($this->authService->login($data))
        {
            return redirect()->route('homePage'); 
        }
        return redirect()->back()->withErrors(['email' => 'Wrong email or password']);
    }

    public function logout(): RedirectResponse
    {
        auth('web')->logout();
        return redirect()->route('loginPage');
    }
}
