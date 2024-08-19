@extends('adminlte::page')

@section('title', 'Edit Service')

@section('content_header')
    <h1>Edit Service</h1>
@stop

@section('content')
    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title (English)</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $service->title }}" required>
        </div>
        <div class="form-group">
            <label for="title_ar">Title (Arabic)</label>
            <input type="text" name="title_ar" class="form-control" id="title_ar" value="{{ $service->title_ar }}" required>
        </div>
        <div class="form-group">
            <label for="title_ur">Title (Urdu)</label>
            <input type="text" name="title_ur" class="form-control" id="title_ur" value="{{ $service->title_ur }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description (English)</label>
            <textarea name="description" class="form-control" id="description" required>{{ $service->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="description_ar">Description (Arabic)</label>
            <textarea name="description_ar" class="form-control" id="description_ar" required>{{ $service->description_ar }}</textarea>
        </div>
        <div class="form-group">
            <label for="description_ur">Description (Urdu)</label>
            <textarea name="description_ur" class="form-control" id="description_ur" required>{{ $service->description_ur }}</textarea>
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
            <input type="file" name="icon" class="form-control-file" id="icon">
            <small class="form-text text-muted">Leave blank to keep the current icon.</small>
        </div>
        @if ($service->icon)
            <div class="form-group">
                <label>Current Icon</label>
                <br>
                <img src="{{ asset('images/icons/' . $service->icon) }}" alt="Icon" width="100">
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Update Service</button>
    </form>
@stop
