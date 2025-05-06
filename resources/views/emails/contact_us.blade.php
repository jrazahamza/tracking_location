<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            color: #333;
            padding: 20px;
        }
        .email-wrapper {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 30px;
        }
        h2 {
            color: #007bff;
            margin-top: 0;
        }
        p {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <h2>New Contact</h2>

        <p><span class="label">Full Name:</span> {{ $data['name'] }}</p>
        <p><span class="label">Email:</span> {{ $data['email'] }}</p>
        <p><span class="label">Subject:</span> {{ $data['subject'] }}</p>
        <p><span class="label">Message:</span> {{ $data['message'] }}</p>
    </div>
</body>
</html>
