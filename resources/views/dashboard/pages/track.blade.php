@extends('dashboard.layouts.main')
@section('content')
    <div class="container mt-5">
        <h3>Tracking: {{ $email }}</h3>
        <div id="map" style="width: 100%; height: 500px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        </div>
    </div>
@endsection
@section('js')
    <script>
        function initMap() {
            const location = {
                lat: {{ $latitude }},
                lng: {{ $longitude }}
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });
            new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuntvsKMaVBt5UEMOzbh5BmY5KnOBAozw&callback=initMap"></script>
@endsection
