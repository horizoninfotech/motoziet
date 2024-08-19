@extends('adminlte::page')

@section('title', 'Service Details')

@section('content_header')
    <h1><i class="fas fa-info-circle"></i> Service Details</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-cogs"></i> {{ $service->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>English Title:</strong></p>
            @if ($service->title)
            <p>{{$service->title}}</p>
            <hr>
            @endif
            <p><strong>Arabic Title:</strong></p>
            @if ($service->title_ar)
            <p>{{$service->title_ar}}</p>
            <hr>
            @endif
            <p><strong>Urdu Title:</strong></p>
            @if ($service->title_ur)
            <p>{{$service->title_ur}}</p>
            <hr>
            @endif
            @if ($service->description)
            <p><strong><i class="fas fa-align-left"></i> English Description:</strong></p>
            <p>{{ $service->description }}</p>
            <hr>        
            @endif
            @if ($service->description_ar)
            <p><strong><i class="fas fa-align-left"></i> Arabic Description:</strong></p>
            <p>{{ $service->description_ar }}</p>
            <hr>        
            @endif
            @if ($service->description_ur)
            <p><strong><i class="fas fa-align-left"></i> Urdu Description:</strong></p>
            <p>{{ $service->description_ru }}</p>
            <hr>        
            @endif
             <!-- Category Information -->
             <p><strong>Category:</strong></p>
             @if ($service->category)
                 <p>{{ $service->category->name }}</p>
             @else
                 <p><i class="fas fa-exclamation-circle"></i> No category assigned</p>
             @endif
             <hr>
            
            <p><strong><i class="fas fa-image"></i> Icon:</strong></p>
            @if ($service->icon)
                <img src="{{ asset('images/icons/' . $service->icon) }}" alt="Icon" width="100">
            @else
                <p><i class="fas fa-exclamation-circle"></i> No icon available</p>
                
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.services.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-url="{{ route('admin.services.destroy', $service->id) }}">
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
                    <i class="fas fa-question-circle"></i> Are you sure you want to delete this service? This action cannot be undone.
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
        });
    </script>
@stop
