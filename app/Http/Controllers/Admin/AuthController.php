<?php

namespace App\Http\Controllers\Admin;

use App\Classes\BaseController;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
   final public function login(AuthRequest $request)
    {
        $user = (new User())->getUserByEmailorPhone($request->all());
        if ($user && Hash::check($request->input('password'), $user->password)) {
            $user_data['token'] = $user->createToken($user->email)->plainTextToken;
            $user_data['name'] = $user->name;
            $user_data['phone'] = $user->phone;
            $user_data['photo'] = $user->photo;
            return $this->sendResponse("Login successfully done", "success", $user_data);

        }

        throw ValidationException::withMessages([
            'email' => ['The Provided Credentials are invalid']
        ]);
    }

   final public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse("Logged Out Successfully", "success");
    }
}
