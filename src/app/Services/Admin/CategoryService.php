<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
use App\Models\Category;
use App\Models\Post;

class CategoryService
{
    /**
     * Display a listing of the categories.
     *
     * @return mixed
     */
    public function index(): mixed
    {
        return Category::paginate(20);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param StoreRequest $request
     * @return mixed
     */
    public function store(StoreRequest $request): mixed
    {
        $data = $request->validated();

        return Category::firstOrCreate($data);
    }

    /**
     * Display the specified category.
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return Post::where('category_id', $id)
            ->paginate(20);
    }

    /**
     * Update the specified category in storage.
     *
     * @param UpdateRequest $request
     * @param Category $category
     * @return Category
     */
    public function update(UpdateRequest $request, Category $category): Category
    {
        $category->update(
            $request->validated()
        );

        return $category;
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Category $category
     * @return bool|null
     */
    public function destroy(Category $category): bool|null
    {
        Post::where('category_id', $category->id)
            ->update(['category_id' => NULL]);

        return $category->delete();
    }
}
