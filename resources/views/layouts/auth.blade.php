<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Authentication')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-r from-gray-900 via-purple-900 to-gray-900 text-white min-h-screen flex items-center justify-center">
<div class="bg-gray-800 p-8 rounded shadow-md w-full max-w-md">
    @yield('content')
</div>
<footer class="text-center mt-8">
    <p class="text-white text-sm">{{ config('app.name') }} &bull; Made with <span class="text-red-600">♥</span> by <a target="_blank" href="https://github.com/EpicnessTwo">EpicKitty</a></p>
</footer>
</body>
</html>
