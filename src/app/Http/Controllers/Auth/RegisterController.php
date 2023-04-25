<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * User registration.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $data = $request->validate([
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'email'         => 'required|string|unique:users,email',
            'password'      => 'required|string|confirmed'
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return new Response(
            $response, 201
        );
    }
}
