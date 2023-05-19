<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Requests\Admin\Users\SearchRequest;
use App\Http\Requests\Admin\Users\SortRequest;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends BaseController
{
    /**
     * Display a listing of the users.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(
            $this->service->index()
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
        return new JsonResponse(
            $this->service->store(
                $request
            )
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
            $this->service->show(
                $user
            )
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
        return new JsonResponse(
            $this->service->update(
                $request, $user
            )
        );
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): JsonResponse
    {
        return new JsonResponse(
            $this->service->destroy(
                $user
            ),204
        );
    }

    /**
     * Search user by name.
     *
     * @param SearchRequest $request
     * @return JsonResponse
     */
    public function search(SearchRequest $request): JsonResponse
    {
        return new JsonResponse(
            $this->service->search(
                $request
            )
        );
    }

    /**
     * Sort by fields.
     *
     * @param SortRequest $request
     * @return JsonResponse
     */
    public function sort(SortRequest $request): JsonResponse
    {
        return new JsonResponse(
            $this->service->sort(
                $request
            )
        );
    }
}
