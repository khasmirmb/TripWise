<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body>
    <p>Dear {{ $booking->contactPerson->name }},</p>

    <p>Thank you for booking with us! Your booking details are as follows:</p>

    <ul>
        <li><strong>Reference Number:</strong> {{ $booking->reference_number }}</li>
        <li><strong>Schedule Number:</strong> {{ $booking->schedule->schedule_number }}</li>
    </ul>

    <p>We appreciate your business!</p>

    <p>You can use the <strong>Reference Number</strong> to manage your booking and the <strong>Schedule Number</strong> to check the trip details. Please keep these details safe for future reference.</p>

    <p>If you have any questions or need further assistance, feel free to contact our customer support at devtripwise@gmail.com</p>

    <p>Safe travels on your journey!</p>
</body>
</html>
