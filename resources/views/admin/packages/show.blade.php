@extends('adminlte::page')

@section('title', 'Package Details')

@section('content_header')
    <h1><i class="fas fa-info-circle"></i> Package Details</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-box"></i> {{ $package->name }}</h3>
    </div>
    <div class="card-body">
        <p><strong><i class="fas fa-align-left"></i> Description:</strong></p>
        <p>{{ $package->description }}</p>
        <p><strong><i class="fas fa-dollar-sign"></i> Price:</strong></p>
        <p>{{ $package->price }}</p>
        <p><strong><i class="fas fa-image"></i> Image:</strong></p>
        @if ($package->image)
            <img src="{{ asset('images/packages/' . $package->image) }}" alt="Image" width="100">
        @else
            <p><i class="fas fa-exclamation-circle"></i> No image available</p>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.packages.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
        <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-url="{{ route('admin.packages.destroy', $package->id) }}">
            <i class="fas fa-trash-alt"></i> Delete
        </button>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <i class="fas fa-question-circle"></i> Are you sure you want to delete this package? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirmDelete">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
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
