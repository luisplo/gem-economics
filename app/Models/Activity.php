<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'value', 'intervals_id', 'frequency'];

    public function getAllInstance(): Collection
    {
        return $this->all();
    }

    public function storeInstance($request): Model
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

    public function intervals(): BelongsTo
    {
        return $this->belongsTo(Interval::class);
    }
}
