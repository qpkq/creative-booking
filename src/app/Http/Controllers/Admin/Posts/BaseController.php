<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Services\Admin\PostService;

class BaseController extends Controller
{
    public PostService $service;

    /**
     * Create a new controller instance.
     *
     * @param PostService $service
     */
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
}
