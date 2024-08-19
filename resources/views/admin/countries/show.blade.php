@extends('adminlte::page')

@section('title', 'Country Details')

@section('content_header')
    <h1>Country Details</h1>
    <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3>{{ $country->name }}</h3>
    </div>
    <div class="card-body">
        <p><strong>Name (Arabic):</strong> {{ $country->name_ar }}</p>
        <p><strong>Name (Urdu):</strong> {{ $country->name_ur }}</p>
        <p><strong>ISO Code:</strong> {{ $country->iso_code }}</p>
        <p><strong>Phone Code:</strong> {{ $country->phone_code }}</p>
        <p><strong>Created At:</strong> {{ $country->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $country->updated_at }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.countries.edit', $country->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
    </div>
</div>
@stop
