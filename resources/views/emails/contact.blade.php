<!-- resources/views/emails/contact.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body>
    <h2>Message recu de la part {{ $names }}</h2>
    <p><strong>From:</strong> {{ $names }} ({{ $emails }})</p>
    <p><strong>Message:</strong></p>
    <p>{{ $messages }}</p>
</body>
</html>
