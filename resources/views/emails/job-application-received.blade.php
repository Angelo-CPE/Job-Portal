<!DOCTYPE html>
<html>
<head>
    <title>New Job Application</title>
</head>
<body>
    <h1>New Job Application</h1>

    <p><strong>Job:</strong> {{ $listingTitle }}</p>
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Sex:</strong> {{ $sex }}</p>
    <p><strong>Birthdate:</strong> {{ $birthdate }}</p>
    <p><strong>Address:</strong> {{ $address }}</p>
    <p><strong>School:</strong> {{ $school }}</p>
    <p><strong>Phone:</strong> {{ $phone }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Desired Salary:</strong> ₱{{ $salary }}</p>
    <p><strong>Time:</strong> {{ $time }}</p>

    <p><strong>Raw Resume Path:</strong> {{ $resume }}</p>

    <p><strong>Resume Link:</strong> 
        <a href="{{ asset('' . $resume) }}" target="_blank" style="color: blue;">
            View Resume
        </a>
    </p>

    <p>Thank you!</p>
</body>
</html>
