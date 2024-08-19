@extends('adminlte::page')

@section('title', 'Edit Package')

@section('content_header')
    <h1>Edit Package</h1>
@stop

@section('content')
<form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $package->name }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description">{{ $package->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control" id="price" value="{{ $package->price }}" required>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control-file" id="image">
        <small class="form-text text-muted">Leave blank to keep the current image.</small>
    </div>
    @if ($package->image)
        <div class="form-group">
            <label>Current Image</label>
            <br>
            <img src="{{ asset('images/packages/' . $package->image) }}" alt="Image" width="100">
        </div>
    @endif
    <button type="submit" class="btn btn-primary">Update Package</button>
</form>
@stop
