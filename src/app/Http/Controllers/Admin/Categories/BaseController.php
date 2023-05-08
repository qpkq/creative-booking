<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;

class BaseController extends Controller
{
    public CategoryService $service;

    /**
     * Create a new controller instance.
     *
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
}
