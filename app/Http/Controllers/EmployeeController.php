<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\CreateRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(private EmployeeService $employeeService)
    {
    }

    public function index(Request $request)
    {
        $employees = $this->employeeService->getAll(data: $request->all(), paginate: true);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
    }

    public function store(CreateRequest $request)
    {
    }

    public function edit(Employee $emloyee)
    {
    }

    public function update(UpdateRequest $request, Employee $emloyee)
    {
    }

    public function destroy(Employee $emloyee)
    {
    }
}
