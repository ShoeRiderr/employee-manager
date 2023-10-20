<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\CreateRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Http\Controllers\Traits\AfterUseDbObject;
use App\Models\Employee;
use App\Models\FoodPreference;
use App\Services\CompanyService;
use App\Services\EmployeeService;
use App\Services\FoodPreferenceService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class EmployeeController extends Controller
{
    use AfterUseDbObject;

    public function __construct(
        private EmployeeService $employeeService,
        private CompanyService $companyService,
        private FoodPreferenceService $foodPreferenceService
    ) {
    }

    public function index(Request $request): View|Factory
    {
        $employees = $this->employeeService->getAll(data: $request->all(), paginate: true);

        return view(
            'employees.index',
            [
                'employees' => $employees,
                'companies' => $this->companyService->getAll(),
                'foodPreferences' => $this->foodPreferenceService->getAll(),
            ]
        );
    }

    public function create(): View|Factory
    {
        return view('employees.create', [
            'companies' => $this->companyService->getAll(),
            'foodPreferences' => $this->foodPreferenceService->getAll(),
        ]);
    }

    public function store(CreateRequest $request): Redirector|RedirectResponse
    {
        $result = $this->employeeService->store($request->validated());

        return $this->rediretWithMessage((bool)$result->id, 'store', Employee::class, route('employees.index'));
    }

    public function edit(Employee $employee): View|Factory
    {
        $employee->load(['company', 'foodPreference']);

        return view('employees.edit', [
            'employee' => $employee,
            'companies' => $this->companyService->getAll(),
            'foodPreferences' => $this->foodPreferenceService->getAll(),
        ]);
    }

    public function update(Employee $employee, UpdateRequest $request)
    {
        $result = $this->employeeService->update($employee, $request->validated());

        return $this->rediretWithMessage($result, 'update', Employee::class, route('employees.index'));
    }

    public function restore(Employee $employee)
    {
        $result = $this->employeeService->restore($employee);

        return $this->rediretWithMessage($result, 'restore', Employee::class, route('employees.index'));
    }

    public function archive(Employee $employee)
    {
        $result = $this->employeeService->archive($employee);

        return $this->rediretWithMessage($result, 'archive', Employee::class, route('employees.index'));
    }

    public function destroy(Employee $employee)
    {
        $result = $this->employeeService->delete($employee);

        return $this->rediretWithMessage($result, 'destroy', Employee::class, route('employees.index'));
    }
}
