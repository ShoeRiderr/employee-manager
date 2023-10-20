<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodPreference\CreateRequest;
use App\Http\Resources\FoodPreferenceResource;
use App\Services\FoodPreferenceService;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodPreferenceController extends Controller
{
    public function __construct(private FoodPreferenceService $foodPreferenceService)
    {}

    public function index(): JsonResource
    {
        $result = $this->foodPreferenceService->getAll();

        return FoodPreferenceResource::collection($result);
    }

    public function store(CreateRequest $request): JsonResource
    {
        $result = $this->foodPreferenceService->store($request->validated());

        return FoodPreferenceResource::make($result);
    }
}
