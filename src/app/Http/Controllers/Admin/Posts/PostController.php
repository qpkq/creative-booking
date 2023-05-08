<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Requests\Admin\Posts\StoreRequest;
use App\Http\Requests\Admin\Posts\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends BaseController
{
    /**
     * Display a listing of the posts.
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
     * Creating a new post.
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
     * Display the specified post.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return new JsonResponse(
            $this->service->show(
                $post
            )
        );
    }

    /**
     * Update the specified post in storage.
     *
     * @param UpdateRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Post $post): JsonResponse
    {
        return new JsonResponse(
            $this->service->update(
                $request, $post
            )
        );
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        return new JsonResponse(
            $this->service->destroy(
                $post
            ), 204
        );
    }
}
