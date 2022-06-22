<!DOCTYPE html>
<html>
<head>
    <title>Data Mangement System</title>
</head>
<body>
    <h1>Dear {{ $details['name'] }}</h1>
    <p>Please find the profile details below</p>
    <p>Username: {{ $details['email'] }}</p> 
    <p>Password: {{ $details['password'] }}</p> 
    <p>Thank you</p>
</body>
</html>