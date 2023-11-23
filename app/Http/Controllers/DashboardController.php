<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ActivityService;
use App\Services\RewardService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    private $activityService;
    private $rewardService;

    public function __construct(ActivityService $activityService, RewardService $rewardService)
    {
        $this->activityService = $activityService;
        $this->rewardService = $rewardService;
    }

    public function index(): JsonResponse
    {
        return $this->successResponse([
            'activities' => $this->activityService->getStats(),
            'rewards' => $this->rewardService->getStats(),
        ]);
    }
}
