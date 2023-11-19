<?php

namespace App\Services;

use App\Models\Reward;

class RewardService
{
    protected $model;

    public function __construct(Reward $reward)
    {
        $this->model = $reward;
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
}
