<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CompleteActivity extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    protected $fillable = ['activity_id', 'init_value', 'value'];

    public function activity(): HasOne
    {
        return $this->hasOne(Activity::class);
    }

    public function storeInstance($request): Model
    {
        return $this->create($request);
    }

    public function getByDay($activityId, $date): Collection
    {
        return $this->whereDate('created_at', $date)->where('activity_id', $activityId)->get();
    }

    public function getByBetweenDate($activityId, $start, $end): Collection
    {
        return $this->whereBetween('created_at', [$start, $end])->where('activity_id', $activityId)->get();
    }
}
