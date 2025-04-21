<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Job Application</title>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.7/dist/tailwind.min.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">New Job Application</h1>

        <div class="space-y-4">
            <p class="text-lg text-gray-700"><strong>Job:</strong> <span class="font-medium text-gray-900">{{ $listingTitle }}</span></p>
            <p class="text-lg text-gray-700"><strong>Name:</strong> <span class="font-medium text-gray-900">{{ $name }}</span></p>
            <p class="text-lg text-gray-700"><strong>Sex:</strong> <span class="font-medium text-gray-900">{{ $sex }}</span></p>
            <p class="text-lg text-gray-700"><strong>Birthdate:</strong> <span class="font-medium text-gray-900">{{ $birthdate }}</span></p>
            <p class="text-lg text-gray-700"><strong>Address:</strong> <span class="font-medium text-gray-900">{{ $address }}</span></p>
            <p class="text-lg text-gray-700"><strong>School:</strong> <span class="font-medium text-gray-900">{{ $school }}</span></p>
            <p class="text-lg text-gray-700"><strong>Phone:</strong> <span class="font-medium text-gray-900">{{ $phone }}</span></p>
            <p class="text-lg text-gray-700"><strong>Email:</strong> <span class="font-medium text-gray-900">{{ $email }}</span></p>
            <p class="text-lg text-gray-700"><strong>Desired Salary:</strong> <span class="font-medium text-gray-900">₱{{ $salary }}</span></p>
            <p class="text-lg text-gray-700"><strong>Time:</strong> <span class="font-medium text-gray-900">{{ $time }}</span></p>

            <p class="text-lg text-gray-700"><strong>Resume Link:</strong> 
                <a href="{{ asset($resume) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium">
                    View Resume
                </a>
            </p>
        </div>

        <p class="text-center text-gray-500 mt-8">Thank you for applying! Kindly wait 10-15 days for us to get back at your application.</p>
    </div>

</body>
</html>