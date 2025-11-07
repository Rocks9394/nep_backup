<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Khelo India</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            padding: 20px;
            color: #333;
        }
        .container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        .footer {
            font-size: 12px;
            margin-top: 20px;
            color: #777;
        }
        h2 {
            color: #2c3e50;
        }
        .info {
            margin-top: 15px;
            line-height: 1.6;
        }
        .credentials {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome {{ $user->name }},</h2>

        <p>Welcome to <strong>GoForFit Fitness Program</strong>. you are successfully mapped with {{ strtoupper($school) }} , kindly login to web portal and start assesment in assigned schools.</p>

        <p>Your account details are given below.</p>
        <div class="credentials">
            Username: {{ $user->email }}<br>
            Registration Number: {{ $user->self_registrationId }}<br>
            Password : 
        </div>

        <p>If you face any issues, feel free to contact GoForFit support.</p>

        <div class="footer">
            Regards,<br>
            <strong>GoForFit Support Team</strong><br>
            Email: <a href="mailto:goforfitsupport@seqfast.com">goforfitsupport@seqfast.com</a>
        </div>
    </div>
</body>
</html>
