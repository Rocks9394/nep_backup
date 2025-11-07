<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Card</title>
</head>
<body>
    <h1>Dear {{ $student->name }},</h1>

    <p>Here is your report card for the month of {{ now()->format('F Y') }}:</p>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student->grades as $grade) <!-- Assuming a relationship 'grades' in your Student model -->
                <tr>
                    <td>{{ $grade->subject }}</td>
                    <td>{{ $grade->grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Best regards,</p>
    <p>Your School</p>
</body>
</html>