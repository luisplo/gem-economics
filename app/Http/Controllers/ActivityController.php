<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
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
        $activities = $this->model->getAllWithIntervalsInstance();

        return $this->successResponse(
            $this->activityService->validateActiveActivity($activities),
        );
    }

    public function store(ActivityRequest $request): JsonResponse
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
        $activity = $this->model->where('id', $id)->get();
        $data = $activity->first();
        $this->completeActivityModel->create([
            'activity_id' => $data->id,
            'value' => $data->value,
            'init_value' => $data->value,
            'user_id' =>  Auth::user()->id,
        ]);

        return $this->successResponse(
            $this->activityService->validateActiveActivity($activity),
            Response::HTTP_CREATED
        );
    }
}
