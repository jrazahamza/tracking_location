<!DOCTYPE html>
<html>
<head><title>Tracking Location</title></head>
<body>
<h3>Tracking: {{ $email }}</h3>
<div id="map" style="width: 100%; height: 500px;"></div>
<script>
function initMap() {
    const location = { lat: {{ $latitude }}, lng: {{ $longitude }} };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: location,
    });
    new google.maps.Marker({ position: location, map: map });
}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuntvsKMaVBt5UEMOzbh5BmY5KnOBAozw&callback=initMap">
</script>
</body>
</html>
