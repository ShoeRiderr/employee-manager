<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">
                    @sortablelink('id', '#', [], ['class' => 'text-decoration-none text-dark'])
                </th>
                <th scope="col">
                    @sortablelink('company.name', __('employee.company'), [], ['class' => 'text-decoration-none text-dark'])
                </th>
                <th scope="col">
                    @lang('employee.food_preference')
                </th>
                <th scope="col">
                    @sortablelink('email', __('employee.email'), [], ['class' => 'text-decoration-none text-dark'])
                </th>
                <th scope="col d-flex">
                    @sortablelink('first_name', __('employee.first_name'), [], ['class' => 'text-decoration-none text-dark'])
                </th>
                <th scope="col">
                    @sortablelink('last_name', __('employee.last_name'), [], ['class' => 'text-decoration-none text-dark'])
                </th>
                <th scope="col">
                    @lang('employee.phone_numbers')
                </th>
                <th scope="col">
                    @lang('form.actions')
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <th scope="row">{{ $employee->id }}</th>
                    <td>{{ $employee->company->name }}</td>
                    <td>{{ $employee->foodPreference->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>

                    <td>
                        {{ implode(', ', $employee->phone_numbers) }}
                    </td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-outline-primary"
                                href="{{ route('employees.edit', [
                                    'employee' => $employee,
                                ]) }}">
                                @lang('form.edit')
                            </a>
                            <form class="ms-2"
                                action="{{ route('employees.archive', [
                                    'employee' => $employee,
                                ]) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <button class="btn btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this usere?');">
                                    @lang('form.delete')
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pt-2 d-flex justify-content-end">
        {{ $employees->links() }}
    </div>
</div>
