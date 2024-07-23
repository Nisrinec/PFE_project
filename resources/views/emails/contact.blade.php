<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
</head>
<body>
    <h1>Contact Form Submission</h1>
    <p><strong>Name:</strong> {{ is_string($name) ? $name : 'Invalid data type' }}</p>
    <p><strong>Email:</strong> {{ is_string($email) ? $email : 'Invalid data type' }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ is_string($descrition) ? $descrition : 'Invalid data type' }}</p>
</body>
</html>
