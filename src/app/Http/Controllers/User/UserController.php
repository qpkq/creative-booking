<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Returns the given user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return new JsonResponse(
            $request->user(), 200
        );
    }

    /**
     * Update the specified user in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        if (isset($data['email'])) {
            $user['email'] = $data['email'];
            $user['email_verified_at'] = NULL;
            $user->sendEmailVerificationNotification();
        }

        $user->fill($data)->update();

        return new JsonResponse(
            $user, 200
        );
    }
}
