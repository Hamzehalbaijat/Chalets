<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
</head>
<body>
    <h2>New Contact Form Submission</h2>
    
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subject:</strong> {{ $data['subject'] ?? 'No subject' }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>
    
    <p>Received at: {{ now()->format('Y-m-d H:i:s') }}</p>
</body>
</html>