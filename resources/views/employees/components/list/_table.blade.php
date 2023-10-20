<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <th scope="row">{{ $employee->id }}</th>
                    <td>{{ $employee->company->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ implode(', ', $employee->phone_numbers) }}</td>
                    <td>{{ $employee->foodPreference->name }}</td>
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
