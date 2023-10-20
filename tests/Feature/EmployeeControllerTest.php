<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Employee::factory(20)->create();
    }

    public function test_employee_index_view_without_any_parameters(): void
    {
        $response = $this->get('/employees');

        $response->assertStatus(Response::HTTP_OK);
        $this->assertInstanceOf(Paginator::class, $response->viewData('employees'));
    }

    public function test_employee_index_view_filter_by_name(): void
    {
        $response = $this->get('/employees');

        $response->assertStatus(Response::HTTP_OK);
        $this->assertInstanceOf(Paginator::class, $response->viewData('employees'));
    }
}
