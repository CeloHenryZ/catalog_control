<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\SignupAuthRequest;
use App\Services\Auth\Login;
use App\Services\Auth\Signup;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['signup', 'login']);
    }

    public function signup(SignupAuthRequest $request, Signup $service)
    {
        $data = $service->handle($request);
        return response()->json($data, 200);
    }

    public function login(LoginAuthRequest $request, Login $service)
    {
        $data = $service->handle($request);
        if(!$data['status']){
            return response()->json($data, $data['code']);
        }
        return response()->json($data, 200);
    }
}
