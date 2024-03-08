<?php

namespace App\Services\Auth;

use App\Exceptions\Auth\LoginUnauthorizedException;
use App\Http\Requests\Auth\LoginAuthRequest;
use Illuminate\Support\Facades\Auth;

class Login
{
    public function handle(LoginAuthRequest $request)
    {
        $requestValidated = (object)$request->validated();

        $token = Auth::guard('api')->attempt([
            'email' => $requestValidated->email,
            'password' => $requestValidated->password,
        ]);

        if (!$token) {
            $data['message'] = 'unauthorized';
            $data['code'] = 401;
            $data['status'] = false;
            return $data;

        }

        $user = Auth::guard('api')->user();

        $data['status'] = true;
        $data['user'] = $user;
        $data['authorization']['token'] = $token;
        $data['authorization']['type'] = 'bearar';

        return $data;
    }
}
