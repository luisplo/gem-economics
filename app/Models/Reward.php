<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Reward extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    protected $fillable = ['name', 'description', 'value', 'intervals_id', 'frequency', 'user_id'];

    public function intervals(): BelongsTo
    {
        return $this->belongsTo(Interval::class);
    }

    public function storeInstance($request, $user): Model
    {
        return $this->create($request);
    }

    public function getInstance($id): Model
    {
        return $this->findOrFail($id);
    }

    public function updateInstance($request, $id): Model
    {
        if ($data = $this->findOrFail($id)) {
            $data->update($request);
            return $data;
        };
    }

    public function destroyInstance($id): Model
    {
        if ($data = $this->findOrFail($id)) {
            $data->delete();
            return $data;
        };
    }

    public function getAllWithIntervalsInstance(): Collection
    {
        return $this->with('intervals')->get();
    }
}
