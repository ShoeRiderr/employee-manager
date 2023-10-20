@extends('layouts.app')

@section('title', 'Employee List')

@section('content')
    @include('employees.components.form', [
        'action' => route('employees.store'),
        'btnText' => __('form.create')
    ])
@endsection
