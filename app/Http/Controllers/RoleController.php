<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(): JsonResponse
    {
        return $this->successResponse($this->roleService->index());
    }

    public function store(Request $request): JsonResponse
    {
        return $this->successResponse(
            $this->roleService->store($request->all()),
            Response::HTTP_CREATED
        );
    }

    public function show($id): JsonResponse
    {
        return $this->successResponse(
            $this->roleService->show($id)
        );
    }

    public function update(Request $request, $id): JsonResponse
    {
        return $this->successResponse(
            $this->roleService->update($request->all(), $id)
        );
    }

    public function destroy($id): JsonResponse
    {
        return $this->successResponse(
            $this->roleService->destroy($id)
        );
    }
}
