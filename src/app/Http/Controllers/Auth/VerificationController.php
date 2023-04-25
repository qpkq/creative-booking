<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Sending a verification notification to the user.
     *
     * @param Request $request
     * @param $id
     * @param $hash
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id, $hash): JsonResponse
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return new JsonResponse(
                ['message' => 'Неверный хэш для верификации email'], 400
            );
        }

        if ($user->hasVerifiedEmail()) {
            return new JsonResponse(
                ['message' => 'Email уже подтвержден'], 200
            );
        }

        $user->markEmailAsVerified();

        return new JsonResponse(
            ['message' => 'Email подтвержден'], 200
        );
    }
}
