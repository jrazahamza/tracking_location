<!DOCTYPE html>
<html>
<head><title>Share Location</title></head>
<body>
<h2>Allow location access</h2>
<script>
navigator.geolocation.getCurrentPosition(function (position) {
    fetch("{{ route('tracking.save-location') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            token: "{{ $trackingRequest->token }}",
            latitude: position.coords.latitude,
            longitude: position.coords.longitude
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        window.close();
    });
}, function (error) {
    alert("Location access denied.");
});
</script>
</body>
</html>
