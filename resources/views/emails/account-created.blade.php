<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to {{ config('app.name') }}</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px;">
    <div style="background: #fff; padding: 30px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #333;">🎉 Welcome to {{ config('app.name') }}!</h2>
        <p>Hello {{ $name }},</p>
        <p>Your account has been successfully created.</p>
        <p><strong>Here are your login credentials:</strong></p>
        <ul>
            <li><strong>Email:</strong> {{ $email }}</li>
            <li><strong>Password:</strong> {{ $password }}</li>
        </ul>
        <p>You can now log in to your account using the link below:</p>
        <p><a href="{{ url('/login') }}" style="background: #3490dc; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Login to Your Account</a></p>
        <br>
        <p>If you have any questions or need assistance, feel free to reply to this email.</p>
        <p>Thank you,<br><strong>{{ config('app.name') }} Team</strong></p>
    </div>
</body>
</html>
