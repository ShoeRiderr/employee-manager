@push('scripts')
    @vite('resources/js/employees/app.js')
@endpush

<form action="{{ $action }}" method="POST">
    @csrf

    @isset($method)
        <input type="hidden" name="_method" value="{{ $method }}">
    @endisset

    @include('components.form._select_form_group', [
        'checkedValue' => isset($employee) ? $employee->company_id : '',
        'label' => __('employee.company'),
        'name' => 'company_id',
        'values' => $companies,
    ])

    @include('components.form._select_form_group', [
        'checkedValue' => isset($employee) ? $employee->food_preference_id : '',
        'label' => __('employee.food_preference'),
        'name' => 'food_preference_id',
        'values' => $foodPreferences,
    ])

    @include('components.form._input_form_group', [
        'name' => 'email',
        'type' => 'email',
        'label' => __('employee.email'),
        'value' => isset($employee) ? $employee->email : '',
    ])

    @include('components.form._input_form_group', [
        'name' => 'first_name',
        'label' => __('employee.first_name'),
        'value' => isset($employee) ? $employee->first_name : '',
    ])

    @include('components.form._input_form_group', [
        'name' => 'last_name',
        'label' => __('employee.last_name'),
        'value' => isset($employee) ? $employee->last_name : '',
    ])

    @include('employees.components.form._phone_num_list', [
        'numbers' => isset($employee) ? $employee->phone_numbers : [],
    ])

    <div class="mt-2">
        <button class="btn btn-outline-primary w-100">{{ $btnText ?? __('form.submit') }}</button>
    </div>
</form>
