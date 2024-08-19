@extends('adminlte::page')

@section('title', 'Approved Companies')

@section('content_header')
    <h1>Approved Companies</h1>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="GET" action="{{ route('admin.companies.approved') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search for companies..." value="{{ request('search') }}">
        <span class="input-group-append">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>
    </div>
</form>

@if ($companies->isEmpty())
    <p>No companies have been approved yet.</p>
@else
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>TRN</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->mobile }}</td>
                    <td>{{ $company->registration_tax_number }}</td>
                    <td>{{ $company->country->name }}</td>
                    <td>{{ $company->state }}</td>
                    <td>{{ $company->city }}</td>
                    <td>
                        <a href="{{ route('admin.companies.show', $company->id) }}" class="btn btn-warning btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.companies.services', $company->id) }}" class="btn btn-primary btn-sm" title="Manage Services">
                            <i class="fas fa-cogs"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <div class="d-flex justify-content-center">
        {{ $companies->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
    </div>
@endif
@stop
