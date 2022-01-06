<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function me()
    {
        return Auth::guard("api")->user();
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route("user.login"));
    }


    public function loginApi(Request $request)
    {
        $cred = $request->only(["email", "password"]);
        $token = Auth::guard("api")->attempt($cred);
        if ($token) {
            return response()->json([
                "message" => "Login success",
                "data" => [
                    "token" => "Bearer " . $token
                ]
            ]);
        }


        return response()->json([
            "message" => "unauthorized access"
        ], 401);
    }
    public function login(UserAuthLoginRequest $request)
    {
        $cred = $request->only(["email", "password"]);
        $login = Auth::attempt($cred, $request->remember_me);
        if ($login) {
            return "login success";
        } else {
            return redirect()->back()
                ->withInput($request->only("email"))
                ->withErrors([
                    "error" => "User not found"
                ]);
        }
    }
}
