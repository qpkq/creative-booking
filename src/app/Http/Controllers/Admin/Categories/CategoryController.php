<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Requests\Admin\Categories\SearchRequest;
use App\Http\Requests\Admin\Categories\SortRequest;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the categories.
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
     * Store a newly created category in storage.
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
     * Display the specified category.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return new JsonResponse(
            $this->service->show(
                $category->id
            )
        );
    }

    /**
     * Update the specified category in storage.
     *
     * @param UpdateRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Category $category): JsonResponse
    {
        return new JsonResponse(
            $this->service->update(
                $request, $category
            )
        );
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        return new JsonResponse(
            $this->service->destroy(
                $category
            )
        );
    }

    /**
     * Search categories of the title.
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
