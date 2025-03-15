<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-r from-gray-900 via-purple-900 to-gray-900 text-white min-h-screen">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 p-6">
        <h2 class="text-2xl font-bold text-purple-500 mb-2">Admin Panel</h2>
        <a href="{{ route('dashboard.home') }}" class="block text-purple-300 hover:text-purple-400 mb-6">Back to Dashboard</a>
        <nav>
            <ul>
                <!-- Users Section -->
                <li class="mb-4">
                    <h3 class="text-purple-400 font-semibold">Users</h3>
                    <ul class="ml-4 mt-2">
                        <li class="mb-2">
                            <a href="{{ route('dashboard.admin.users.index') }}" class="hover:text-purple-300">Manage Users</a>
                        </li>
                    </ul>
                </li>
                <!-- Categories Section -->
                <li class="mb-4">
                    <h3 class="text-purple-400 font-semibold">Categories</h3>
                    <ul class="ml-4 mt-2">
                        <li class="mb-2">
                            <a href="{{ route('dashboard.admin.categories.index') }}" class="hover:text-purple-300">Manage Categories</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('dashboard.admin.keywords.index') }}" class="hover:text-purple-300">Manage Keywords</a>
                        </li>
                    </ul>
                </li>
                <!-- Chat Rooms Section -->
                <li class="mb-4">
                    <h3 class="text-purple-400 font-semibold">Chat Rooms</h3>
                    <ul class="ml-4 mt-2">
                        <li class="mb-2">
                            <a href="{{ route('dashboard.admin.public_rooms.index') }}" class="hover:text-purple-300">Manage Public Rooms</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('dashboard.admin.private_rooms.index') }}" class="hover:text-purple-300">Manage Private Rooms</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</div>
@yield('scripts')
</body>
</html>
