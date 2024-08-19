@extends('adminlte::page')

@section('title', 'Countries')

@section('content_header')
    <h1>Countries</h1>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="GET" action="{{ route('admin.countries.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search for countries..." value="{{ request('search') }}">
        <span class="input-group-append">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>
    </div>
</form>

<a href="{{ route('admin.countries.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Add New Country
</a>

@if ($countries->isEmpty())
    <p>No countries found.</p>
@else
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Name (Arabic)</th>
                <th>Name (Urdu)</th>
                <th>ISO Code</th>
                <th>Phone Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->name_ar }}</td>
                    <td>{{ $country->name_ur }}</td>
                    <td>{{ $country->iso_code }}</td>
                    <td>{{ $country->phone_code }}</td>
                    <td>
                        <a href="{{ route('admin.countries.show', $country->id) }}" class="btn btn-info btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.countries.edit', $country->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{ $country->id }}">
                            <i class="fas fa-trash-alt"></i> 
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <div class="d-flex justify-content-center">
        {{ $countries->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
    </div>
@endif

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this country? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = $('#deleteForm');
        var url = "{{ route('admin.countries.destroy', ':id') }}";
        form.attr('action', url.replace(':id', id));
    });
</script>
@stop
