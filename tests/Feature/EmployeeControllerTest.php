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

        Employee::factory(20);
    }

    public function test_employee_index_view(): void
    {
        $response = $this->get('/employees');

        $response->assertStatus(Response::HTTP_OK);
        $this->assertInstanceOf(Paginator::class, $response->viewData('employees'));
    }
}
