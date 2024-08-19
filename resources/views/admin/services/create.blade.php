@extends('adminlte::page')

@section('title', 'Create Service')

@section('content_header')
    <h1>Create Service</h1>
@stop

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="fas fa-list"></i> View All Services
        </a>
        <a href="{{ route('admin.services.create') }}" class="btn btn-warning">
            <i class="fas fa-redo"></i> Clear Form
        </a>
    </div>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title (English)</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter title in English" required>
        </div>
        <div class="form-group">
            <label for="title_ar">Title (Arabic)</label>
            <input type="text" name="title_ar" class="form-control" id="title_ar" placeholder="Enter title in Arabic" required>
        </div>
        <div class="form-group">
            <label for="title_ur">Title (Urdu)</label>
            <input type="text" name="title_ur" class="form-control" id="title_ur" placeholder="Enter title in Urdu" required>
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
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="0" disabled {{ old('category_id', $service->category_id ?? 0) == 0 ? 'selected' : '' }}>Please select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $service->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="file" name="icon" class="form-control-file" id="icon" required>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Create Service
        </button>
    </form>
@stop
