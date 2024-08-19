@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Categories</h1>
@stop

@section('content')
<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus-circle"></i> Add New Category
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
                <th>Icon</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td><img src="{{ asset('images/icons/' . $category->icon) }}" alt="Icon" width="50"></td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                                data-toggle="modal" data-target="#deleteModal" data-url="{{ route('admin.categories.destroy', $category->id) }}">
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
                    Are you sure you want to delete this category? This action cannot be undone.
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

            // Handle showing the modal
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                deleteUrl = button.data('url'); // Extract info from data-* attributes
            });

            // Handle the delete confirmation
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

            // Prevent modal from showing automatically on page refresh
            if (window.location.hash === '#deleteModal') {
                $('#deleteModal').modal('hide');
            }
        });
    </script>
@stop
