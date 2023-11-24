<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use App\Models\CompleteActivity;
use App\Services\ActivityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    private $activityService;
    private $model;
    private $completeActivityModel;

    public function __construct(
        ActivityService $activityService,
        Activity $activity,
        CompleteActivity $completeActivityModel
    ) {
        $this->activityService = $activityService;
        $this->model = $activity;
        $this->completeActivityModel = $completeActivityModel;
    }

    public function index(): JsonResponse
    {
        return $this->successResponse($this->activityService->getAllWithIntervals());
    }

    public function store(ActivityRequest $request): JsonResponse
    {
        return $this->successResponse(
            $this->model->create(
                [...$request->validated(), 'user_id' => Auth::user()->id]
            ),
            Response::HTTP_CREATED
        );
    }

    public function destroy(string $id): JsonResponse
    {
        return $this->successResponse($this->model->findOrFail($id)->delete());
    }

    public function complete(string $id): JsonResponse
    {
        $activity = $this->model->findOrFail($id);
        $response = $this->completeActivityModel->create([
            'activity_id' => $activity->id,
            'value' => $activity->value,
            'init_value' => $activity->value,
            'user_id' =>  Auth::user()->id,
        ]);

        return $this->successResponse($response, Response::HTTP_CREATED);
    }
}
