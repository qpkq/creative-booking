<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * User authorization.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        $fields = $request->validate([
            'email'         => 'required|string',
            'password'      => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad data'
            ], 401);
        }

        $token = $user->createToken('BearerToken')->plainTextToken;

        $response = [
            'user'      => $user,
            'token'     => $token
        ];

        return response($response, 201);
    }
}
