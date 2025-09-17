<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> 

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Document</title>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center mb-6">Parking Reservations</h1>

        <!-- Current Reservations Section -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-center mb-4">Current Reservations</h2>
            <div class="flex justify-center items-center">
                <div class="bg-white p-4 rounded-lg shadow-md w-full md:w-1/2 lg:w-1/3 flex flex-col ">
                    <h3 class="text-lg font-bold text-center">Reservation #1234</h3>
                    <p class="text-sm text-gray-600 text-center">Spot: A12</p>
                    <p class="text-sm text-gray-600 text-center">Time: 10:00 AM - 12:00 PM</p>
                    <button class="mt-4 px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-lg hover:bg-red-600 transition ">
                        Cancel Reservation
                    </button>
                </div>
            </div>
        </section>

        <!-- Past Reservations Section -->
        <section>
            <h2 class="text-2xl font-semibold text-center mb-4">Past Reservations</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold">Reservation #1222</h3>
                    <p class="text-sm text-gray-600">Spot: C8</p>
                    <p class="text-sm text-gray-600">Time: 8:00 AM - 9:30 AM</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold">Reservation #1219</h3>
                    <p class="text-sm text-gray-600">Spot: A10</p>
                    <p class="text-sm text-gray-600">Time: 6:00 PM - 7:30 PM</p>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
