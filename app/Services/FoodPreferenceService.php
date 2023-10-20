<?php

namespace App\Services;

use App\Models\FoodPreference;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FoodPreferenceService
{
    public function getAll(bool $paginate = false, int $perPage = 10, array $data = []): Collection|LengthAwarePaginator
    {
        $queryBuilder = FoodPreference::query();

        if ($paginate) {
            return $queryBuilder->paginate($perPage);
        }

        return $queryBuilder->get();
    }

    public function store(array $data): FoodPreference
    {
        return FoodPreference::create($data);
    }

    public function update(FoodPreference $foodPreference, array $data): bool
    {
        return $foodPreference->update($data);
    }

    public function restore(FoodPreference $foodPreference): bool
    {
        return $foodPreference->restore();
    }

    public function archive(FoodPreference $foodPreference): bool
    {
        return $foodPreference->delete();
    }

    public function delete(FoodPreference $foodPreference): bool
    {
        return $foodPreference->forceDelete();
    }
}
