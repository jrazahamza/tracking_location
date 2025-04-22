<!-- resources/views/emails/tracking_request.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracking Request</title>
</head>
<body>
    <h1>Tracking Request</h1>
    <p>You are requested to share your location. Click below:</p>
    <a href="{{ route('approve.tracking.request', $token) }}" class="btn">Share Location</a>
</body>
</html>
