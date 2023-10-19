<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class EmployeeService
{
    public function getAll(array $data, bool $paginate = false, int $perPage = 10)
    {
        $queryBuilder = Employee::query()
            ->when(Arr::get($data, 'relations'), fn (Builder $query, $relations) => $query->with($relations))
            ->when(Arr::get($data, 'first_name'), fn (Builder $query, $firstName) => $query->where('first_name', $firstName))
            ->when(Arr::get($data, 'last_name'), fn (Builder $query, $lastName) => $query->where('last_name', $lastName))
            ->when(Arr::get($data, 'email'), fn (Builder $query, $email) => $query->where('email', $email))
            ->when(Arr::get($data, 'company_id'), fn (Builder $query, $companyId) => $query->where('company_id', $companyId));

        if ($paginate) {
            return $queryBuilder->paginate($perPage);
        }

        $queryBuilder->get();
    }

    public function create($data)
    {
        Employee::create($data);
    }
}
