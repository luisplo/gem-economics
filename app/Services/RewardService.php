<?php

namespace App\Services;

use App\Enum\Interval;
use App\Http\Resources\ActivityResource;
use App\Models\CompleteActivity;
use App\Models\CompleteReward;
use App\Models\Reward;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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

    public function completeReward(Collection $reward)
    {
        $data = $reward->first();
        $query = $this->completeActivity->where('value', '>', 0)->latest('value')->get();

        $totalValues = $data->value;

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

        $this->completeReward->create([
            'reward_id' => $data->id,
            'value' => $data->value,
            'user_id' => Auth::user()->id,
        ]);

        return $reward;
    }

    public function getStats(): array
    {
        return [
            'complete' => $this->model->where('disabled', true)->count(),
            'incomplete' => $this->model->where('disabled', false)->count()
        ];
    }

    public function validateActiveReward(Collection $rewards)
    {
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
}
