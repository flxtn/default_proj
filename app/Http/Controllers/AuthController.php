<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
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

    public function register(RegisterRequest $request): View | RedirectResponse
    {
        $data = $request->validated();
        $user = $this->authService->register($data);
        if($user)
        {
            $svgQrCode = $this->authService->generateQrCode($user);
            return view('auth.two-factor-challenge', compact('user', 'svgQrCode'));
        }
        return redirect()->back()->withErrors(['email' => 'Wrong email, name or password']);
    }

    public function login(LoginRequest $request): View | RedirectResponse
    {
        $data = $request->validated();
        $user = $this->authService->login($data);
        if ($user)
        {
            return view('auth.two-factor-login', compact('user')); 
        }
        return redirect()->back()->withErrors(['email' => 'Wrong email or password']);
    }

    public function logout(): RedirectResponse
    {
        auth('web')->logout();
        return redirect()->route('loginPage');
    }


    public function EnableTwoFa(CodeRequest $request, $id)
    {
        $data = $request->validated();
        list('user' => $user, 'isValid' => $isValid) = $this->authService->checkCode($id, $data); 
        if ($isValid) 
        {
            $user->two_fa_status = true;
            $user->save();
            return redirect()->route('loginPage');
        }else{
            return redirect()->back()->withErrors(['code' => 'Wrong code']);
        }
    }


    public function TwoFactorLogin(CodeRequest $request, $id)
    {
        $data = $request->validated();
        list('user' => $user, 'isValid' => $isValid) = $this->authService->checkCode($id, $data); 
        if ($isValid && $user->is_active)
        {
            auth()->login($user);
            return redirect()->route('homePage');
        }else if ($isValid && !$user->is_active){
            return view('auth.not-active');
        }
        else{
            return redirect()->back()->withErrors(['code' => 'Wrong code']);
        }
    }


}
