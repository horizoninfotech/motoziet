@extends('adminlte::page')

@section('title', 'Company Details')

@section('content_header')
    <h1>Company Details</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3>{{ $company->name }}</h3>
    </div>
    <div class="card-body">
        <p><strong>Email:</strong> {{ $company->email }}</p>
        <p><strong>Mobile:</strong> {{ $company->mobile }}</p>
        <p><strong>Registration Tax Number:</strong> {{ $company->registration_tax_number }}</p>
        <p><strong>Country:</strong>
        @if ($company->country)
            {{ $company->country->name }}
        @else
            <i class="fas fa-exclamation-circle"></i> No Country assigned
        @endif
    </p>
        <p><strong>State:</strong> {{ $company->state }}</p>
        <p><strong>City:</strong> {{ $company->city }}</p>

        @if ($company->latitude && $company->longitude)
            <h4>Location</h4>
            <div id="map" style="height: 300px;"></div>
        @else
            <p><strong>Location:</strong> Not available</p>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.companies.pending') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>
@stop

@section('js')
@if ($company->latitude && $company->longitude)
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}"></script>
    <script>
        function initMap() {
            var location = { lat: parseFloat('{{ $company->latitude }}'), lng: parseFloat('{{ $company->longitude }}') };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
        initMap();
    </script>
@endif
@stop
