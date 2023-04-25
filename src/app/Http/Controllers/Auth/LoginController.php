<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * User authorization.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response {
        $fields = $request->validate([
            'email'         => 'required|string',
            'password'      => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return new Response([
                'message' => 'Bad data'
            ], 401);
        }

        $token = $user->createToken('BearerToken')->plainTextToken;

        $response = [
            'user'      => $user,
            'token'     => $token
        ];

        return new Response(
            $response, 201
        );
    }
}
