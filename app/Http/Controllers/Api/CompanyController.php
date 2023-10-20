<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateRequest;
use App\Http\Resources\CompanyResource;
use App\Services\CompanyService;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyController extends Controller
{
    public function __construct(private CompanyService $companyService)
    {}

    public function index(): JsonResource
    {
        $result = $this->companyService->getAll();

        return CompanyResource::collection($result);
    }

    public function store(CreateRequest $request): JsonResource
    {
        $result = $this->companyService->store($request->validated());

        return CompanyResource::make($result);
    }
}
