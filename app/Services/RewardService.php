<?php

namespace App\Services;

use App\Enum\Interval;
use App\Models\CompleteActivity;
use App\Models\CompleteReward;
use App\Models\Reward;

class RewardService
{
    protected $model;
    protected $completeReward;
    protected $completeActivity;

    public function __construct(Reward $reward, CompleteReward $completeReward, CompleteActivity $completeActivity)
    {
        $this->model = $reward;
        $this->completeReward = $completeReward;
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
        $rewards = $this->model->getAllWithIntervalsInstance();

        $rewards->map(function ($reward) {
            if ($reward->intervals->id === Interval::DAY) {
                $complete = $this->completeReward->getByDay($reward->id, today());
            } else if ($reward->intervals->id === Interval::WEEK) {
                $complete = $this->completeReward->getByBetweenDate($reward->id, today()->startOfWeek(), today()->endOfWeek());
            } else if ($reward->intervals->id === Interval::MONTH) {
                $complete = $this->completeReward->getByBetweenDate($reward->id, today()->startOfMonth(), today()->endOfMonth());
            } else if ($reward->intervals->id === Interval::YEAR) {
                $complete = $this->completeReward->getByBetweenDate($reward->id, today()->startOfYear(), today()->endOfYear());
            }

            if ($reward->frequency <= $complete->count()) {
                $reward->disabled = true;
                $reward->update();
            } else {
                if (self::getRequiredValues() >= $reward->value) {
                    $reward->disabled = false;
                } else {
                    $reward->disabled = true;
                }
            }
        });

        return $rewards;
    }

    public function getRequiredValues()
    {
        return $this->completeActivity->where('disabled', false)->sum('value');
    }

    public function completeReward($request)
    {
        $query = $this->completeActivity->where('disabled', false)->get();
        $totalValues = 0;
        foreach ($query as $item) {
            if ($item->value <= $request['value']) {
                $totalValues += $item->value;
                $item->disabled = true;
                $item->update();
            } else if ($item->value > $request['value']) {
                $item->value = $item->value - $request['value'];
                $item->update();

                $totalValues += $request['value'];
            }

            if ($totalValues == $request['value']) {
                $this->completeReward->storeInstance($request);
                break;
            }
        }
    }

    public function getStats()
    {
        return [
            'complete_rewards' => $this->model->where('disabled', true)->count(),
            'incomplete_rewards' => $this->model->where('disabled', false)->count()
        ];
    }
}
