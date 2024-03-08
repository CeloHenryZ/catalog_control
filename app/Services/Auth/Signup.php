<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\SignupAuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Signup
{
    public function handle(SignupAuthRequest $request)
    {
        $requestValidated = (object)$request->validated();

        $user = User::create([
            'name' => $requestValidated->name,
            'email' => $requestValidated->email,
            'password' => Hash::make($requestValidated->password),
        ]);


        $token = Auth::guard('api')->login($user);

        $data['status'] = 'success';
        $data['message'] = 'User created successfully';
        $data['user'] = $user;
        $data['authorization']['token'] = $token;
        $data['authorization']['type'] = 'bearer';

        return $data;
    }
}
