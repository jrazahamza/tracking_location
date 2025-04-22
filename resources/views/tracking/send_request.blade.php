
<!-- resources/views/tracking/send_request.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Tracking Request</title>
</head>
<body>
    <h1>Send Tracking Request</h1>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('tracking.send') }}">
        @csrf
        <input type="email" name="email" placeholder="Enter email to track" required>
        <button type="submit">Send Request</button>
    </form>
    @if(session('message')) <p>{{ session('message') }}</p> @endif
</body>
</html>
