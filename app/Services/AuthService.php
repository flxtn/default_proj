<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;



class AuthService
{
    public function register(array $data)
    {

        $user = User::create(["name" => $data["name"],
        "email" => $data["email"], 
        "password" => $data["password"]]);

        if ($user) {
            auth("web")->login($user);
            return true;
        }
        return false;
    }

    public function login(array $data)
    {

        if (auth("web")->attempt($data))
        {
            return true;
        } 
        return false;

    }

}

