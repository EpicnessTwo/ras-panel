<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ras Panel - Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-r from-gray-900 via-purple-900 to-gray-900 text-white min-h-screen flex items-center justify-center">
<div class="text-center px-24 py-18 bg-gray-800 bg-opacity-75 rounded-lg shadow-lg">
    <h1 class="text-5xl font-bold mb-4 text-purple-500">Ras Panel</h1>
    <p class="text-xl mb-4 text-purple-300">A web panel for Retro AIM Server</p>
    <p class="text-lg mb-12 text-purple-200">Join our {{ \App\Models\User::count() }} users!</p>
    <div class="space-x-4">
        @guest
            <a href="{{ route('login') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded transition duration-300">
                Login
            </a>
            <a href="{{ route('register') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded transition duration-300">
                Register
            </a>
        @endguest
        @auth
            <a href="{{ route('dashboard.home') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded transition duration-300">
                Go to Dashboard
            </a>
        @endauth
    </div>
</div>
</body>
</html>
