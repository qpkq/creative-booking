<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;

class BaseController extends Controller
{
    public DashboardService $service;

    /**
     * Create a new controller instance.
     *
     * @param DashboardService $service
     */
    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }
}
