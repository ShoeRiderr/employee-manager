@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
    @include('employees.components.form', [
        'action' => route('employees.update', [
            'employee' => $employee
        ]),
        'btnText' => __('form.edit'),
        'employee' => $employee,
        'method' => 'PUT',
    ])
@endsection
