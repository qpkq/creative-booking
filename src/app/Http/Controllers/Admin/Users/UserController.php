<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(
            User::all(), 200
        );
    }

    /**
     * Create new user.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        return new JsonResponse(
            User::firstOrCreate($data),201
        );
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return new JsonResponse(
            $user, 200
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
        $user->update($request->validated());

        return new JsonResponse(
            $user, 200
        );
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        return new Response(
            $user->delete(),204
        );
    }
}
