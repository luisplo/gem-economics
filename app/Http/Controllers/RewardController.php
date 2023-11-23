<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RewardRequest;
use App\Models\CompleteReward;
use App\Models\Reward;
use App\Services\RewardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RewardController extends Controller
{
    private $rewardService;
    private $model;

    public function __construct(
        RewardService $rewardService,
        Reward $reward,
    ) {
        $this->rewardService = $rewardService;
        $this->model = $reward;
    }

    public function index(): JsonResponse
    {
        return $this->successResponse($this->rewardService->getAllWithIntervals());
    }

    public function store(RewardRequest $request): JsonResponse
    {
        return $this->successResponse($this->model->create($request->validated()), Response::HTTP_CREATED);
    }

    public function destroy(string $id): JsonResponse
    {
        return $this->successResponse($this->model->findOrFail($id)->delete());
    }

    public function complete(string $id): JsonResponse
    {
        $response = $this->rewardService->completeReward($id);
        return $this->successResponse($response, Response::HTTP_CREATED);
    }
}
