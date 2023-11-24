<?php

namespace App\Services;

use App\Enum\Interval;
use App\Models\CompleteActivity;
use App\Models\CompleteReward;
use App\Models\Reward;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RewardService
{
    protected $model;
    protected $completeReward;
    protected $completeActivity;

    public function __construct(
        Reward $reward,
        CompleteReward $completeReward,
        CompleteActivity $completeActivity
    ) {
        $this->model = $reward;
        $this->completeReward = $completeReward;
        $this->completeActivity = $completeActivity;
    }

    public function getAllWithIntervals(): Collection
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
                if ($this->completeActivity->where('value', '>', 0)->sum('value') >= $reward->value) {
                    $reward->disabled = false;
                } else {
                    $reward->disabled = true;
                }
            }
        });

        return $rewards;
    }

    public function completeReward(string $id): Model
    {
        $reward = $this->model->findOrFail($id);
        $query = $this->completeActivity->where('value', '>', 0)->latest('value')->get();

        $totalValues = $reward->value;

        foreach ($query as $item) {
            if ($totalValues <= 0) break;

            if ($item->value >= $totalValues) {
                $item->value -= $totalValues;
                $totalValues = 0;
            } else {
                $totalValues -= $item->value;
                $item->value = 0;
            }

            $item->update();
        }

        return $this->completeReward->create([
            'reward_id' => $reward->id,
            'value' => $reward->value,
            'user_id' => Auth::user()->id,
        ]);
    }

    public function getStats(): array
    {
        return [
            'complete' => $this->model->where('disabled', true)->count(),
            'incomplete' => $this->model->where('disabled', false)->count()
        ];
    }
}
