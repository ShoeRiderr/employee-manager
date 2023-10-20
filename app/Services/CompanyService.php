<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    public function getAll(bool $paginate = false, int $perPage = 10, array $data = []): Collection|LengthAwarePaginator
    {
        $queryBuilder = Company::query();

        if ($paginate) {
            return $queryBuilder->paginate($perPage);
        }

        return $queryBuilder->get();
    }

    public function store(array $data): Company
    {
        return Company::create($data);
    }

    public function update(Company $company, array $data): bool
    {
        return $company->update($data);
    }

    public function restore(Company $company): bool
    {
        return $company->restore();
    }

    public function archive(Company $company): bool
    {
        return $company->delete();
    }

    public function delete(Company $company): bool
    {
        return $company->forceDelete();
    }
}
