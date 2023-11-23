<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Interval;
use Illuminate\Http\JsonResponse;

class IntervalController extends Controller
{
    private $model;

    public function __construct(Interval $interval)
    {
        $this->model = $interval;
    }

    public function index(): JsonResponse
    {
        return $this->successResponse($this->model->all());
    }
}
