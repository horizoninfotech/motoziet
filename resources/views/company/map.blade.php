@extends('layouts.app')

@section('title', 'Company Locations')

@section('css')
<style>
    #map {
        height: 500px;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h3>Companies Near You</h3>
    <div id="map"></div>
</div>
@endsection

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&libraries=places"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var map;
        var markers = [];
        var infowindow = new google.maps.InfoWindow();

        function initMap() {
            // Get user's current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    map = new google.maps.Map(document.getElementById('map'), {
                        center: userLocation,
                        zoom: 12
                    });

                    // Place a marker for the user's current location
                    var userMarker = new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: 'Your Location',
                        icon: {
                            path: google.maps.SymbolPath.CIRCLE,
                            scale: 7,
                            fillColor: '#4285F4',
                            fillOpacity: 1,
                            strokeWeight: 0,
                            strokeColor: '#fff'
                        }
                    });

                    // Loop through companies and place markers
                    var companies = @json($companies);
                    companies.forEach(function(company) {
                        var marker = new google.maps.Marker({
                            position: { lat: parseFloat(company.latitude), lng: parseFloat(company.longitude) },
                            map: map,
                            title: company.name
                        });

                        marker.addListener('click', function() {
                            infowindow.setContent('<h5>Name: ' + company.name + '</h5><p>' + 'City: ' + company.city + ', State: ' + company.state + '</p><div><a href="">View<a>');
                            infowindow.open(map, marker);
                        });

                        markers.push(marker);
                    });
                }, function() {
                    handleLocationError(true, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, pos) {
            alert(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
        }

        initMap();
    });
</script>
@endsection
