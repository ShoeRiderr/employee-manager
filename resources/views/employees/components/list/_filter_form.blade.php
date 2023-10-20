<form action="{{ route('employees.index') }}" method="GET">
    @include('components.form._input_form_group', [
        'name' => 'email',
        'type' => 'email',
        'label' => __('employee.email'),
        'value' => app('request')->input('email', ''),
    ])

    @include('components.form._input_form_group', [
        'name' => 'first_name',
        'label' => __('employee.first_name'),
        'value' => app('request')->input('first_name', ''),
    ])

    @include('components.form._input_form_group', [
        'name' => 'last_name',
        'label' => __('employee.last_name'),
        'value' => app('request')->input('last_name', ''),
    ])

    @include('components.form._select_form_group', [
        'checkedValue' => app('request')->input('company_id', ''),
        'label' => __('employee.company'),
        'name' => 'company_id',
        'values' => $companies,
    ])

    <div class="mt-4 d-flex flex-md-row flex-column justify-content-md-end">
        <button class="btn btn-outline-warning">
            @lang('form.filter')
        </button>
    </div>
</form>
