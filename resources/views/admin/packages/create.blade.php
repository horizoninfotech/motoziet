@extends('adminlte::page')

@section('title', 'Create Package')

@section('content_header')
    <h1>Create Package</h1>
@stop

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
        <i class="fas fa-list"></i> View All Packages
    </a>
    <a href="{{ route('admin.packages.create') }}" class="btn btn-warning">
        <i class="fas fa-redo"></i> Clear Form
    </a>
</div>

<form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter package name" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" placeholder="Enter description"></textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" class="form-control" id="price" placeholder="Enter price" required>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control-file" id="image" required>
    </div>
    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Create Package
    </button>
</form>
@stop
