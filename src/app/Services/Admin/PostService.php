<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Posts\SearchRequest;
use App\Http\Requests\Admin\Posts\SortRequest;
use App\Http\Requests\Admin\Posts\StoreRequest;
use App\Http\Requests\Admin\Posts\UpdateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostService
{
    /**
     * Display a listing of the posts.
     *
     * @return array
     */
    public function index(): array
    {
        return [
            'posts' => Post::with('category')->get(),
        ];
    }

    /**
     * Creating a new post.
     *
     * @param StoreRequest $request
     * @return Collection
     */
    public function store(StoreRequest $request): Collection
    {
        $data = $request->validated();

        if (!empty($data['tags_ids'])) {
            $tagIds = $data['tags_ids'];
            unset($data['tags_ids']);
        }

        if (!empty($data['image']))
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);

        $post = Post::firstOrCreate($data);

        if (isset($tagIds)) {
            $post->tags()
                ->attach($tagIds);
        }

        return Post::with('category')
            ->where('id', $post['id'])
            ->get();
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @return Collection
     */
    public function show(Post $post): Collection
    {
        return Post::with('category')
            ->where('id', $post['id'])
            ->get();
    }

    /**
     * Update the specified post in storage.
     *
     * @param UpdateRequest $request
     * @param Post $post
     * @return Collection
     */
    public function update(UpdateRequest $request, Post $post): Collection
    {
        $data = $request->validated();

        if (!empty($data['tags_ids'])) {
            $tagIds = $data['tags_ids'];
            unset($data['tags_ids']);
        }

        if (!empty($data['image']))
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);

        $post->update($data);

        if (isset($tagIds)) {
            $post->tags()
                ->sync($tagIds);
        }

        return Post::with('category')
            ->where('id', $post['id'])
            ->get();
    }

    /**
     * Remove the specified post from storage.
     *
     * @param Post $post
     * @return bool|null
     */
    public function destroy(Post $post): bool|null
    {
        return $post->delete();
    }

    /**
     * Display a listing of the deleted posts.
     *
     * @return Collection
     */
    public function showDeletedPosts(): Collection
    {
        return Post::withTrashed()
            ->onlyTrashed()
            ->get();
    }

    /**
     * Restoring deleted posts.
     *
     * @param int $id
     * @return mixed
     */
    public function restore(int $id): mixed
    {
        Post::withTrashed()
            ->where('id', $id)
            ->restore();

        return Post::findOrFail($id);
    }

    /**
     * Search post of the title.
     *
     * @param SearchRequest $request
     * @return array
     */
    public function search(SearchRequest $request): array
    {
        $data = $request->validated();

        $data = Post::with('category')
            ->where('title', 'LIKE', '%' . $data['title'] . '%')
            ->get();

        return [
            'posts' => $data,
        ];
    }

    /**
     * Sorting by fields.
     *
     * @param SortRequest $request
     * @return LengthAwarePaginator
     */
    public function sort(SortRequest $request): LengthAwarePaginator
    {
        $sortField = $request->input('sort_field', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');

        return Post::with('category')
            ->orderBy($sortField, $sortDirection)
            ->paginate(20);
    }
}
