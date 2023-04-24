<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\StoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return response()->json($request->user(), 200);
    }

    /**
     * Update the specified user in storage.
     *
     * @param StoreRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(StoreRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        if (isset($data['email'])) {
            $user['email'] = $data['email'];
            $user['email_verified_at'] = NULL;
            $user->sendEmailVerificationNotification();
        }

        $user->fill($data)->update();

        return response()->json($user, 200);
    }
}
