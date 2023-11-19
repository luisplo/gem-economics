<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteActivity extends Model
{
    use HasFactory;
    protected $fillable = ['activities_id'];

    public function storeInstance($request): Model
    {
        return $this->create($request);
    }
}
