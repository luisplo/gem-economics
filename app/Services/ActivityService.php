<?php

namespace App\Services;

use App\Enum\Interval;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Models\CompleteActivity;
use App\Models\CompleteReward;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityService
{
    protected $model;
    protected $completeActivity;
    protected $completeReward;

    public function __construct(
        Activity $activity,
        CompleteActivity $completeActivity,
        CompleteReward $completeReward,
    ) {
        $this->model = $activity;
        $this->completeActivity = $completeActivity;
        $this->completeReward = $completeReward;
    }

    public function completeActivity(array $request): Model
    {
        return $this->completeActivity->storeInstance($request);
    }

    public function getStats(): array
    {
        return [
            'values' => $this->completeActivity->where('value', '>', 0)->sum('value'),
            'used_values' => $this->completeReward->sum('value'),
            'complete' => $this->model->where('disabled', true)->count(),
            'incomplete' => $this->model->where('disabled', false)->count()
        ];
    }

    public function validateActiveActivity(Collection $activities): AnonymousResourceCollection
    {
        collect($activities)->map(function ($activity) {
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
        return ActivityResource::collection($activities);
    }
}
