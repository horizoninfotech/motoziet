@extends('adminlte::page')

@section('title', 'Manage Services for ' . $company->name)

@section('content_header')
    <h1>Manage Services for {{ $company->name }}</h1>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <h4>Assigned Services</h4>
        <ul id="assigned-services" class="list-group">
            @foreach ($company->services as $service)
                <li class="list-group-item" data-id="{{ $service->id }}">
                    {{ $service->title }}
                    <span class="float-right">
                        <button type="button" class="btn btn-danger btn-sm remove-service" title="Remove Service">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-6">
        <h4>Available Services</h4>
        <ul id="available-services" class="list-group">
            @foreach ($availableServices as $service)
                <li class="list-group-item" data-id="{{ $service->id }}">
                    {{ $service->title }}
                    <span class="float-right">
                        <button type="button" class="btn btn-success btn-sm assign-service" title="Assign Service">
                            <i class="fas fa-plus"></i>
                        </button>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Remove service
        $('.remove-service').on('click', function() {
            var serviceId = $(this).closest('li').data('id');
            var url = '{{ route("admin.companies.services.remove", ["company" => $company->id]) }}';

            $.post(url, {
                _token: '{{ csrf_token() }}',
                service_id: serviceId
            }, function(response) {
                location.reload();
            });
        });

        // Assign service
        $('.assign-service').on('click', function() {
            var serviceId = $(this).closest('li').data('id');
            var url = '{{ route("admin.companies.services.assign", ["company" => $company->id]) }}';

            $.post(url, {
                _token: '{{ csrf_token() }}',
                service_id: serviceId
            }, function(response) {
                location.reload();
            });
        });
    });
</script>
@stop
