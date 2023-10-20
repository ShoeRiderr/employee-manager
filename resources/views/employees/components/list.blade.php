<div>
    <div class="mb-2">
        @include('employees.components.list._filter_form', [
            'companies' => $companies,
        ])
    </div>
    <div class="mb-4 d-flex flex-md-row flex-column justify-content-md-end">
        <a href="{{route('employees.create')}}" class="btn btn-outline-primary">
            @lang('form.add')
        </a>
    </div>
    <div>
        @include('employees.components.list._table')
    </div>
</div>
