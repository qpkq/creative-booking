<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Requests\Admin\Posts\SearchRequest;
use App\Http\Requests\Admin\Posts\SortRequest;
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
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        return new JsonResponse(
            $this->service->destroy(
                $post
            ), 204
        );
    }

    /**
     * Display a listing of the deleted posts.
     *
     * @return JsonResponse
     */
    public function showDeletedPosts(): JsonResponse
    {
        return new JsonResponse(
            $this->service->showDeletedPosts()
        );
    }

    /**
     * Restoring deleted posts.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        return new JsonResponse(
            $this->service->restore(
                $id
            )
        );
    }

    /**
     * Search post of the title.
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
     * Sorting by fields.
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
