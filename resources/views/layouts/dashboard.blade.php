<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white">
<header class="bg-gray-800 p-4">
    <nav class="container mx-auto flex justify-between items-center">
        <div class="flex space-x-4">
            <a href="{{ route('dashboard.home') }}" class="text-purple-500 hover:text-purple-400">Home</a>
            <a href="{{ route('dashboard.profile') }}" class="text-purple-500 hover:text-purple-400">Profile</a>
        </div>
        <div>
            <span class="text-purple-300">Welcome, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="ml-4 text-purple-500 hover:text-purple-400">Logout</button>
            </form>
        </div>
    </nav>
</header>
<main class="container mx-auto py-8">
    @yield('content')
</main>
</body>
</html>
