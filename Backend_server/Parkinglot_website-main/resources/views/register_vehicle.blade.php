<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> 
    <title>Vehicle Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Register Vehicle</h2>
            <form action="/register-vehicle" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="license_plate" class="block text-sm font-medium text-gray-700">License Plate</label>
                    <input type="text" id="license_plate" name="license_plate" class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-indigo-500" placeholder="ABC-1234" required>
                </div>
                <div>
                    <label for="vehicle_type" class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                    <select id="vehicle_type" name="vehicle_type" class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-indigo-500" required>
                        <option value="">Select Vehicle Type</option>
                        <option value="Car">Car</option>
                        <option value="Truck">Truck</option>
                        <option value="Bus">Bus</option>
                        <option value="Motorcycle">Motorcycle</option>
                    </select>
                </div>
                <div>
                    <label for="owner_name" class="block text-sm font-medium text-gray-700">Owner's Name</label>
                    <input type="text" id="owner_name" name="owner_name" class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-indigo-500" placeholder="John Doe" required>
                </div>
                <div>
                    <label for="owner_identify_number" class="block text-sm font-medium text-gray-700">Owner's ID Number</label>
                    <input type="text" id="owner_identify_number" name="owner_identify_number" class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-indigo-500" placeholder="123456789" required>
                </div>
                <div>
                    <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Register Vehicle</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
