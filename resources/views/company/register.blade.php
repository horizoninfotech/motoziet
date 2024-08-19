@extends('layouts.app')

@section('title', __('registration.title'))

@section('css')
<link href="{{ asset('css/company-registration.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<style>
    #map {
        height: 300px;
        width: 100%;
        margin-bottom: 20px;
    }

    /* Style for input icons */
    .input-icon {
        position: relative;
    }

    .input-icon input,
    .input-icon select {
        padding-left: 40px;
    }

    .input-icon .fa {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: red;
    }
</style>
@endsection

@section('content')
<div class="container company-registration">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ __('registration.title') }}</h3>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('company.submitRegistration') }}">
                        @csrf
                        <div class="form-group pb-3 input-icon">
                            <i class="fas fa-building"></i>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('registration.name') }}" required>
                        </div>
                        <div class="form-group pb-3 input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('registration.email') }}" required>
                        </div>

                        <div class="form-group pb-3 input-icon">
                            <i class="fas fa-file-alt"></i>
                            <input type="text" name="registration_tax_number" id="registration_tax_number" class="form-control" placeholder="{{ __('registration.registration_tax_number') }}" required>
                        </div>
                        <div class="form-group pb-3 input-icon">
                            <i class="fas fa-globe"></i>
                            <select name="country_id" id="country_id" class="form-control" required>
                                <option value="">{{ __('registration.country') }}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country['id'] }}">{{ __($country['name']) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group pb-3 input-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" name="state" id="state" class="form-control" placeholder="{{ __('registration.state') }}" required>
                        </div>
                        <div class="form-group pb-3 input-icon">
                            <i class="fas fa-city"></i>
                            <input type="text" name="city" id="city" class="form-control" placeholder="{{ __('registration.city') }}" required>
                        </div>

                        <div class="form-group pb-3 input-icon">
                            <i class="fas fa-phone"></i>
                            <div class="d-flex">
                                <select name="phone_code" id="phone_code" class="form-control" style="max-width: 100px; margin-right: 10px;" required disabled>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['phone_code'] }}">{{ $country['phone_code'] }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="{{ __('registration.mobile') }}" required>
                            </div>
                        </div>
                        
                        
                        <div class="form-group pb-3 input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('registration.password') }}" required>
                        </div>
                        <div class="form-group pb-3 input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('registration.password_confirmation') }}" required>
                        </div>
                        <div class="form-group pb-3">
                            <div id="map"></div>
                            <input class="d-none" name="latitude" id="latitude">
                            <input class="d-none" name="longitude" id="longitude">
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-user-plus"></i> {{ __('registration.register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}"></script>
<script>
    $(document).ready(function() {
        $('#country_id').select2({
            placeholder: "{{ __('registration.country') }}",
            allowClear: true
        });

        $('#country_id').on('change', function() {
            var selectedCountryId = $(this).val();
            var selectedCountry = @json($countries).find(country => country.id == selectedCountryId);
            if (selectedCountry) {
                $('#phone_code').val(selectedCountry.phone_code);
            }
        });

        // Initialize Google Map
        var map;
        var marker;
        var latitude = document.getElementById('latitude');
        var longitude = document.getElementById('longitude');

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 6
            });

            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: {lat: -34.397, lng: 150.644}
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);
                    marker.setPosition(pos);
                    latitude.value = pos.lat;
                    longitude.value = pos.lng;
                    updateLocationField(pos.lat, pos.lng);
                });
            }

            google.maps.event.addListener(marker, 'dragend', function() {
                var pos = marker.getPosition();
                latitude.value = pos.lat();
                longitude.value = pos.lng();
                updateLocationField(pos.lat(), pos.lng());
            });

            function updateLocationField(lat, lng) {
                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            google_location.value = results[0].formatted_address;
                        }
                    }
                });
            }
        }

        initMap();
    });
</script>
@endsection
