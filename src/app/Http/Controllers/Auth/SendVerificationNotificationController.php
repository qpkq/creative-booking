<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SendVerificationNotificationController extends Controller
{
    /**
     * User email verification.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = User::where(
            'email', $request->email
        )->first();

        if (!$user) {
            return new JsonResponse(
                ['message' => 'Пользователь с таким email не найден'], 404
            );
        }

        if ($user->hasVerifiedEmail()) {
            return new JsonResponse(
                ['message' => 'Email уже подтвержден'], 200
            );
        }

        $user->sendEmailVerificationNotification();

        return new JsonResponse(
            ['message' => 'Письмо для подтверждения email отправлено'], 200
        );
    }
}
