<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;



class AuthService
{
    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required","email","string", "unique:users,email"],
            "password" => ["required", "confirmed"],
        ]);

        $user = User::create(["name" => $data["name"],
        "email" => $data["email"], 
        "password" => bcrypt($data["password"])]);

        if ($user) {
            auth("web")->login($user);
            return true;
        }
        return false;
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => ["required","email","string"],
            "password" => ["required"],
        ]);

        if (auth("web")->attempt($data))
        {
            return true;
        } 
        return false;

    }

}

?>