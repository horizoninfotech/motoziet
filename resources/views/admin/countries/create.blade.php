@extends('adminlte::page')

@section('title', 'Add New Country')

@section('content_header')
    <h1>Add New Country</h1>
    <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.countries.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">Country Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter country name" required>
    </div>

    <div class="form-group">
        <label for="name_ar">Country Name (Arabic)</label>
        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="أدخل اسم البلد بالعربية" required>
    </div>

    <div class="form-group">
        <label for="name_ur">Country Name (Urdu)</label>
        <input type="text" name="name_ur" id="name_ur" class="form-control" placeholder="اردو میں ملک کا نام درج کریں">
    </div>

    <div class="form-group">
        <label for="iso_code">ISO Code</label>
        <input type="text" name="iso_code" id="iso_code" class="form-control" placeholder="Enter ISO code" required>
    </div>

    

    <div class="form-group">
        <label for="phone_code">Phone Code</label>
        <input type="text" name="phone_code" id="phone_code" class="form-control" placeholder="Enter phone code" required>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Add Country
    </button>
    <button type="reset" class="btn btn-warning">
        <i class="fas fa-undo"></i> Clear
    </button>
</form>
@stop
