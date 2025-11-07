<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to GoForFit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        h2 {
            color: #2c3e50;
            margin-top: 0;
        }
        .info {
            margin: 15px 0;
            line-height: 1.6;
        }
        .credentials {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 14px;
            margin: 20px 0;
        }
        .footer {
            font-size: 13px;
            color: #777;
            margin-top: 30px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hi {{ $user->name }},</h2>
        <p>Welcome to the <strong>GoForFit Fitness Program</strong>!</p>
        <div class="info">
            Thank you for registering with us — we’re excited to have you onboard. You can now log in and begin your fitness journey.
        </div>

        <p><strong>Your account details:</strong></p>
        <div class="credentials">
            Username: {{ $user->email }}<br>
            Password: {{ $password }}<br>
            Registration Number: {{ $user->self_registrationId }}
        </div>

        <p>If you face any issues, feel free to contact GoForFit support.</p>
        <div class="footer">
            Best regards,<br>
            <strong>GoForFit Support Team</strong><br>
            Email: <a href="mailto:goforfitsupport@seqfast.com">goforfitsupport@seqfast.com</a>
        </div>
    </div>
</body>
</html>

