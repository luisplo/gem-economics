<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteReward extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    protected $fillable = ['reward_id', 'value'];

    public function storeInstance($request): Model
    {
        return $this->create($request);
    }

    public function getByDay($rewardId, $date): Collection
    {
        return $this->whereDate('created_at', $date)->where('reward_id', $rewardId)->get();
    }

    public function getByBetweenDate($rewardId, $start, $end): Collection
    {
        return $this->whereBetween('created_at', [$start, $end])->where('reward_id', $rewardId)->get();
    }
}
