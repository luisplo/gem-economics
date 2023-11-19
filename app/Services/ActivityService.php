<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\CompleteActivity;

class ActivityService
{
    protected $model;
    protected $completeActivity;

    public function __construct(Activity $activity, CompleteActivity $completeActivity)
    {
        $this->model = $activity;
        $this->completeActivity = $completeActivity;
    }

    public function index()
    {
        return $this->model->getAllInstance();
    }

    public function store($request)
    {
        return $this->model->storeInstance($request);
    }

    public function show($id)
    {
        return $this->model->getInstance($id);
    }

    public function update($request, $id)
    {
        return $this->model->updateInstance($request, $id);
    }

    public function destroy($id)
    {
        return $this->model->destroyInstance($id);
    }

    public function getAllWithIntervals()
    {
        return $this->model->getAllWithIntervalsInstance();
    }

    public function completeActivity($id)
    {
        return $this->completeActivity->storeInstance([
            'activities_id' => $id
        ]);
    }
}
