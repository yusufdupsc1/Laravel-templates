<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(DashboardService $dashboardService): View
    {
        $dashboard = Cache::remember('dashboard-data', 300, function () use ($dashboardService) {
            return $dashboardService->getData();
        });

        return view('dashboard', ['dashboard' => $dashboard]);
    }
}
