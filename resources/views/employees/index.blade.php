@extends('layouts.app')

@section('title', 'Employee List')

@section('content')

@include('employees.components.list', [
    'companies' => $companies
])
@endsection
