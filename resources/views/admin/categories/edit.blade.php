@extends('adminlte::page')

@section('title', 'Edit Catrgory')

@section('content_header')
    <h1>Edit Catrgory</h1>
@stop

@section('content')
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name (English)</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="name_ar">Name (Arabic)</label>
            <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{ $category->name_ar }}" required>
        </div>
        <div class="form-group">
            <label for="name_ur">Name (Urdu)</label>
            <input type="text" name="name_ur" class="form-control" id="name_ur" value="{{ $category->name_ur }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description (English)</label>
            <textarea name="description" class="form-control" id="description" required>{{ $category->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="description_ar">Description (Arabic)</label>
            <textarea name="description_ar" class="form-control" id="description_ar" required>{{ $category->description_ar }}</textarea>
        </div>
        <div class="form-group">
            <label for="description_ur">Description (Urdu)</label>
            <textarea name="description_ur" class="form-control" id="description_ur" required>{{ $category->description_ur }}</textarea>
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="file" name="icon" class="form-control-file" id="icon">
            <small class="form-text text-muted">Leave blank to keep the current icon.</small>
        </div>
        @if ($category->icon)
            <div class="form-group">
                <label>Current Icon</label>
                <br>
                <img src="{{ asset('images/icons/' . $category->icon) }}" alt="Icon" width="100">
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
@stop
