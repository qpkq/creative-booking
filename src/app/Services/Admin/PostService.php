<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Posts\StoreRequest;
use App\Http\Requests\Admin\Posts\UpdateRequest;
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
     * @return null
     */
    public function destroy(Post $post): null
    {
        $post->delete();

        return null;
    }
}
