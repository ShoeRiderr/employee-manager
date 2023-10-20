<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class EmployeeService
{
    public function getAll(array $data = [], bool $paginate = false, int $perPage = 10, $sortDirection = 'desc'): Collection|LengthAwarePaginator
    {
        $queryBuilder = Employee::query()
            ->sortable()
            ->when(Arr::get($data, 'relations'), fn (Builder $query, $relations) => $query->with($relations))
            ->when(Arr::get($data, 'first_name'), fn (Builder $query, $firstName) => $query->where('first_name', 'like', "$firstName%"))
            ->when(Arr::get($data, 'last_name'), fn (Builder $query, $lastName) => $query->where('last_name', 'like', "$lastName%"))
            ->when(Arr::get($data, 'email'), fn (Builder $query, $email) => $query->where('email', $email))
            ->when(Arr::get($data, 'company_id'), fn (Builder $query, $companyId) => $query->where('company_id', $companyId))
            ->orderBy('id', $sortDirection);

        if ($paginate) {
            return $queryBuilder->paginate($perPage);
        }

        return $queryBuilder->get();
    }

    public function store(array $data): Employee
    {
        return Employee::create($data);
    }

    public function update(Employee $employee, array $data): bool
    {
        return $employee->update($data);
    }

    public function restore(Employee $employee): bool
    {
        return $employee->restore();
    }

    public function archive(Employee $employee): ?bool
    {
        return $employee->delete();
    }

    public function delete(Employee $employee): ?bool
    {
        return $employee->forceDelete();
    }
}
