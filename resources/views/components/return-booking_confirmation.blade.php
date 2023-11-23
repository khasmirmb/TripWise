<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Trip Confirmation</title>
</head>
<body>
    <p>Dear {{ $booking->contactPerson->name }},</p>

    <p>Thank you for booking your return trip with us! Your return trip details are as follows:</p>

    <ul>
        <li><strong>Reference Number:</strong> {{ $booking->reference_number }}</li>
        <li><strong>Schedule Number:</strong> {{ $booking->schedule->schedule_number }}</li>
        <!-- Include other return trip details as needed -->
    </ul>

    <p>We appreciate your continued business!</p>

    <p>You can use the <strong>Reference Number</strong> to manage your return booking and the <strong>Schedule Number</strong> to check the return trip details. Please keep these details safe for future reference.</p>

    <p>If you have any questions or need further assistance, feel free to contact our customer support at devtripwise@gmail.com</p>

    <p>Safe travels on your return journey!</p>
</body>
</html>
