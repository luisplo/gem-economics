<?php

namespace App\Services;

use App\Enum\Interval;
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
        $activities = $this->model->getAllWithIntervalsInstance();

        $activities->map(function ($activity) {
            if ($activity->intervals->id === Interval::DAY) {
                $complete = $this->completeActivity->getByDay($activity->id, today());
            } else if ($activity->intervals->id === Interval::WEEK) {
                $complete = $this->completeActivity->getByBetweenDate($activity->id, today()->startOfWeek(), today()->endOfWeek());
            } else if ($activity->intervals->id === Interval::MONTH) {
                $complete = $this->completeActivity->getByBetweenDate($activity->id, today()->startOfMonth(), today()->endOfMonth());
            } else if ($activity->intervals->id === Interval::YEAR) {
                $complete = $this->completeActivity->getByBetweenDate($activity->id, today()->startOfYear(), today()->endOfYear());
            }

            if ($activity->frequency <= $complete->count()) {
                $activity->disabled = true;
            } else {
                $activity->disabled = false;
            }
            $activity->update();
        });

        return $activities;
    }

    public function completeActivity($request)
    {
        return $this->completeActivity->storeInstance($request);
    }

    public function getStats()
    {
        return [
            'values' => $this->completeActivity->where('disabled', false)->sum('value'),
            'used_values' => $this->completeActivity->where('disabled', true)->sum('value'),
            'complete_activities' => $this->model->where('disabled', true)->count(),
            'incomplete_activities' => $this->model->where('disabled', false)->count()
        ];
    }
}
