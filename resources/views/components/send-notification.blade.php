<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyage Notification</title>
</head>
<body>
    <p>Dear {{ $contactPerson->name }},</p>

    <p>This is a friendly reminder that your voyage is coming up soon!</p>

    <p>Your voyage details:</p>

    <ul>
        <li><strong>Departure Port:</strong> {{ $schedule->departure_port }}</li>
        <li><strong>Arrival Port:</strong> {{ $schedule->arrival_port }}</li>
        <li><strong>Departure Date:</strong> {{ $schedule->departure_date }}</li>
        <li><strong>Departure Time:</strong> {{ $schedule->departure_time }}</li>
    </ul>

    <p>We hope you're looking forward to your trip! If you have any questions or need assistance, please don't hesitate to contact us.</p>

    <p>Safe travels!</p>
</body>
</html>