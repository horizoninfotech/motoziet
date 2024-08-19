@extends('adminlte::page')

@section('title', 'Packages')

@section('content_header')
    <h1>Packages</h1>
@stop

@section('content')
<a href="{{ route('admin.packages.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus-circle"></i> Add New Package
</a>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="table-responsive">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($packages as $package)
            <tr>
                <td>{{ $package->name }}</td>
                <td>{{ $package->description }}</td>
                <td><img src="{{ asset('images/packages/' . $package->image) }}" alt="Image" width="50"></td>
                <td>{{ $package->price }}</td>
                <td>{{ $package->created_at }}</td>
                <td>
                    <a href="{{ route('admin.packages.show', $package->id) }}" class="btn btn-info btn-sm" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" title="Delete"
                            data-toggle="modal" data-target="#deleteModal" data-url="{{ route('admin.packages.destroy', $package->id) }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

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
                Are you sure you want to delete this package? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        var deleteUrl = '';

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            deleteUrl = button.data('url');
        });

        $('#confirmDelete').on('click', function() {
            var form = $('<form>', {
                'method': 'POST',
                'action': deleteUrl
            });

            var token = $('<input>', {
                'type': 'hidden',
                'name': '_token',
                'value': '{{ csrf_token() }}'
            });

            var hiddenInput = $('<input>', {
                'type': 'hidden',
                'name': '_method',
                'value': 'DELETE'
            });

            form.append(token, hiddenInput).appendTo('body').submit();
        });
    });
</script>
@stop
