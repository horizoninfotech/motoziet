@extends('adminlte::page')

@section('title', 'Edit Country')

@section('content_header')
    <h1>Edit Country</h1>
    <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.countries.update', $country->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Country Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $country->name }}" required>
    </div>

    <div class="form-group">
        <label for="name_ar">Country Name (Arabic)</label>
        <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $country->name_ar }}" required>
    </div>

    <div class="form-group">
        <label for="name_ur">Country Name (Urdu)</label>
        <input type="text" name="name_ur" id="name_ur" class="form-control" value="{{ $country->name_ur }}">
    </div>

    <div class="form-group">
        <label for="iso_code">ISO Code</label>
        <input type="text" name="iso_code" id="iso_code" class="form-control" value="{{ $country->iso_code }}" required>
    </div>

    <div class="form-group">
        <label for="phone_code">Phone Code</label>
        <input type="text" name="phone_code" id="phone_code" class="form-control" value="{{ $country->phone_code }}" required>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Update Country
    </button>
    <button type="reset" class="btn btn-warning">
        <i class="fas fa-undo"></i> Clear
    </button>
</form>
@stop
