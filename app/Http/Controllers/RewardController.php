<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RewardRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Reward;
use App\Services\RewardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
        $rewards = $this->model->getAllWithIntervalsInstance();
        return $this->successResponse(
            $this->rewardService->validateActiveReward($rewards)
        );
    }

    public function store(RewardRequest $request): JsonResponse
    {
        return $this->successResponse(
            ActivityResource::make($this->model->create(
                [...$request->validated(), 'user_id' => Auth::user()->id]
            )),
            Response::HTTP_CREATED
        );
    }

    public function destroy(string $id): JsonResponse
    {
        $data = $this->model->findOrFail($id);
        $data->delete();
        return $this->successResponse(
            ActivityResource::make($data)
        );
    }

    public function complete(string $id): JsonResponse
    {
        $reward = $this->rewardService->completeReward(
            $this->model->where('id', $id)->get()
        );

        return $this->successResponse(
            ActivityResource::collection($this->rewardService->validateActiveReward($reward)),
            Response::HTTP_CREATED
        );
    }
}
