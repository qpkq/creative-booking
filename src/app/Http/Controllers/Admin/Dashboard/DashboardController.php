<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\JsonResponse;

class DashboardController extends BaseController
{
    /**
     * Blog stats.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(
            $this->service->index()
        );
    }
}
