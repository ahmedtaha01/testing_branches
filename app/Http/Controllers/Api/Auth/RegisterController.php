<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\Responses\HttpResponseTrait;

class RegisterController extends Controller
{
    use HttpResponseTrait;

    public function register(RegisterRequest $request){

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        $user->token = $user->createToken('personal access token')->plainTextToken;

        return $this->success('user logged in successfully',new UserResource($user),200);
    }
}
