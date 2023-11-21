<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ActivityService;
use App\Services\RewardService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $activityService;
    private $rewardService;

    public function __construct(ActivityService $activityService, RewardService $rewardService)
    {
        $this->activityService = $activityService;
        $this->rewardService = $rewardService;
    }
    public function index()
    {
        return view('home', [
            'stats_activities' => $this->activityService->getStats(),
            'stats_rewards' => $this->rewardService->getStats(),
        ]);
    }
}
