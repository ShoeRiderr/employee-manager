<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\FoodPreference;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_index_view_without_any_parameters(): void
    {
        Employee::factory(20)->create();

        $response = $this->get('/employees');

        $response->assertStatus(Response::HTTP_OK);

        $this->assertInstanceOf(Paginator::class, $response->viewData('employees'));
    }

    public function test_employee_index_view_filter_by_first_name(): void
    {
        Employee::factory(20)->create();

        $employee = Employee::first();

        $response = $this->get(route('employees.index', [
            'first_name' => $employee->first_name
        ]));

        $response->assertStatus(Response::HTTP_OK);

        $this->assertInstanceOf(Paginator::class, $response->viewData('employees'));
    }

    public function test_employee_created_successfuly(): void
    {
        FoodPreference::factory(1)->create();
        Company::factory(1)->create();

        $company = Company::first();
        $foodPreference = FoodPreference::first();

        $data = [
            'company_id' => $company->id,
            'food_preference_id' => $foodPreference->id,
            'email' => 'test@example.com',
            'first_name' => 'Test',
            'last_name' => 'Test',
            'phone_numbers' => ['123456789', '789456132'],
        ];

        $response = $this->post(route('employees.store'), $data);

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('employees.index'));

        $data['phone_numbers'] = json_encode($data['phone_numbers']);
        $this->assertDatabaseHas('employees', $data);
        $data['phone_numbers'] = json_decode($data['phone_numbers']);

        $lastEmployee = Employee::latest()->first();

        $this->assertEquals($data['company_id'], $lastEmployee->company_id);
        $this->assertEquals($data['food_preference_id'], $lastEmployee->food_preference_id);
        $this->assertEquals($data['email'], $lastEmployee->email);
        $this->assertEquals($data['first_name'], $lastEmployee->first_name);
        $this->assertEquals($data['last_name'], $lastEmployee->last_name);
        $this->assertEquals($data['phone_numbers'], $lastEmployee->phone_numbers);
    }

    public function test_employee_archived_successfuly(): void
    {
        $employee = Employee::factory()->create();
        $response = $this->patch(route('employees.archive', $employee));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertSessionHas('success', __("crud.archive", ['model' => Employee::class]));
        $response->assertRedirect(route('employees.index'));
    }

    public function test_employee_restored_successfuly(): void
    {
        $employee = Employee::factory()->create();
        $employee->delete();

        $response = $this->patch(route('employees.restore', $employee));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertSessionHas('success', __("crud.restore", ['model' => Employee::class]));
        $response->assertRedirect(route('employees.index'));
    }

    public function test_employee_store_validation_error_redirects_back_to_form(): void
    {
        $data = [
            'company_id' => '',
            'food_preference_id' => '',
            'email' => '',
            'first_name' => '',
            'last_name' => '',
            'phone_numbers' => '',
        ];

        $response = $this->post(route('employees.store'), $data);

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertSessionHasErrors([
            'company_id',
            'food_preference_id',
            'email',
            'first_name',
            'last_name',
            'phone_numbers',
        ]);

        $response->assertRedirect(route('employees.create'));

        $this->assertDatabaseMissing('employees', $data);
    }

    public function test_edit_view_contains_correct_values()
    {
        $employee = Employee::factory()->create();

        FoodPreference::factory(1)->create();
        Company::factory(1)->create();

        $foodPreferences = FoodPreference::all();
        $companies = Company::all();

        $response = $this->get("/employees/$employee->id/edit");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('value="' . $employee->company_id . '"', false);
        $response->assertSee('value="' . $employee->food_preference_id . '"', false);
        $response->assertSee('value="' . $employee->email . '"', false);
        $response->assertSee('value="' . $employee->first_name . '"', false);
        $response->assertSee('value="' . $employee->last_name . '"', false);
        foreach ($employee->phone_numbers as $number) {
            $response->assertSee('value="' . $number . '"', false);
        }
        $response->assertViewHas('employee', $employee);
        $response->assertViewHas('foodPreferences', $foodPreferences);
        $response->assertViewHas('companies', $companies);
    }

    public function test_employee_update_validation_error_redirects_back_to_form(): void
    {
        $employee = Employee::factory()->create();

        $data = [
            'company_id' => '',
            'food_preference_id' => '',
            'email' => '',
            'first_name' => '',
            'last_name' => '',
            'phone_numbers' => '',
        ];

        $response = $this->put("/employees/$employee->id", $data);

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertSessionHasErrors([
            'company_id',
            'food_preference_id',
            'email',
            'first_name',
            'last_name',
            'phone_numbers',
        ]);
        $response->assertRedirect(route('employees.edit', $employee->id));
    }
}
