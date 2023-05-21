<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class DashboardService
{
    /**
     * Blog stats.
     *
     * @return array
     */
    public function index(): array
    {
        // Current date and previous week.
        $weekAgo = Carbon::now()->subWeek();

        return [
            'users'         => User::count(),
            'newUsers'      => User::where('created_at', '>=', $weekAgo)->count(),
            'posts'         => Post::count(),
            'newPosts'      => Post::where('created_at', '>=', $weekAgo)->count(),
            'categories'    => Category::count(),
        ];
    }
}
