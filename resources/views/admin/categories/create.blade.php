@extends('adminlte::page')

@section('title', 'Create Category')

@section('content_header')
    <h1>Create Category</h1>
@stop

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-list"></i> View All Categories
        </a>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-warning">
            <i class="fas fa-redo"></i> Clear Form
        </a>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name (English)</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name in English" required>
        </div>
        <div class="form-group">
            <label for="name_ar">Name (Arabic)</label>
            <input type="text" name="name_ar" class="form-control" id="name_ar" placeholder="Enter name in Arabic" required>
        </div>
        <div class="form-group">
            <label for="name_ur">Name (Urdu)</label>
            <input type="text" name="name_ur" class="form-control" id="name_ur" placeholder="Enter name in Urdu" required>
        </div>
        <div class="form-group">
            <label for="description">Description (English)</label>
            <textarea name="description" class="form-control" id="description" placeholder="Enter description in English" required></textarea>
        </div>
        <div class="form-group">
            <label for="description_ar">Description (Arabic)</label>
            <textarea name="description_ar" class="form-control" id="description_ar" placeholder="Enter description in Arabic" required></textarea>
        </div>
        <div class="form-group">
            <label for="description_ur">Description (Urdu)</label>
            <textarea name="description_ur" class="form-control" id="description_ur" placeholder="Enter description in Urdu" required></textarea>
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="file" name="icon" class="form-control-file" id="icon" required>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Create Category
        </button>
    </form>
@stop
