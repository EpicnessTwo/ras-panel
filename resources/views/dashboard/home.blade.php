@extends('layouts.dashboard')

@section('title', 'Dashboard Home')

@section('content')
    <div class="bg-gray-800 p-6 mb-6 rounded shadow-md">
        <h1 class="text-3xl font-bold text-purple-500 mb-4">{{ config('app.name') }}</h1>
        <p class="mb-4">
            Welcome to your dashboard. Below are the instructions for connecting to the retro-aim-server using the AIM client.
        </p>
    </div>
    <div class="grid grid-cols-2 gap-6">
        <!-- AIM Section -->
        <div class="bg-gray-800 p-6 mb-6 rounded shadow-md">
            @if(auth()->user()->has_aim)
                <h2 class="text-2xl font-semibold text-purple-400 mb-2">Your AIM Details</h2>
                <p class="text-white"><strong>Hostname:</strong> {{ config('ras.public_uri') }}</p>
                <p class="text-white"><strong>Username:</strong> {{ auth()->user()->aim->name }}</p>
                <h2 class="text-xl font-semibold text-purple-400 my-2">Setup Instructions</h2>
                <p class="text-purple-300">
                    You can find the AIM setup instructions here: <a target="_blank" href="https://github.com/mk6i/retro-aim-server/blob/main/docs/CLIENT.md" class="underline hover:text-purple-400">AIM Setup</a>
                </p>
                <!-- AIM Password Update Form -->
                <h2 class="text-xl font-semibold text-purple-400 mb-2 mt-6">Update AIM Password</h2>
                <form method="POST" action="{{ route('dashboard.aim.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="new_aim_password" class="block text-purple-300 text-sm font-bold mb-1">
                            New AIM Password
                        </label>
                        <input type="password" id="new_aim_password" name="new_password" required minlength="4" maxlength="16"
                               title="Password must be between 4 and 16 characters."
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                    </div>
                    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        Update Password
                    </button>
                </form>
                <!-- AIM Delete Button -->
                <button type="button" class="delete-account-btn text-red-500 hover:text-red-400 mt-4"
                        data-delete-url="{{ route('dashboard.aim.destroy') }}">
                    Delete AIM Account
                </button>
            @else
                <h2 class="text-2xl font-semibold text-purple-400 mb-2">Your AIM Details</h2>
                <p class="text-white mb-6">You have not yet registered for AIM. Please register below.</p>
                <form method="POST" action="{{ route('dashboard.aim.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block text-purple-300 text-sm font-bold mb-1">AIM Username</label>
                        <input type="text" id="username" name="username" required
                               pattern="^(?=.{4,15}$)[A-Za-z][A-Za-z0-9 ]*[A-Za-z0-9]$"
                               title="Username must be 4-15 characters, start with a letter, not end with a space, and contain only letters, numbers and spaces."
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-purple-300 text-sm font-bold mb-1">AIM Password (4-16 Characters)</label>
                        <input type="password" id="password" name="password" required minlength="4" maxlength="16"
                               title="Password must be between 4 and 16 characters."
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                    </div>
                    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        Register AIM Account
                    </button>
                </form>
            @endif
        </div>
        <!-- ICQ Section -->
        <div class="bg-gray-800 p-6 mb-6 rounded shadow-md">
            @if(auth()->user()->has_icq)
                <h2 class="text-2xl font-semibold text-purple-400 mb-2">Your ICQ Details</h2>
                <p class="text-white"><strong>Hostname:</strong> {{ config('ras.public_uri') }}</p>
                <p class="text-white"><strong>Username:</strong> {{ auth()->user()->icq->name }}</p>
                <h2 class="text-xl font-semibold text-purple-400 my-2">Setup Instructions</h2>
                <p class="text-purple-300">
                    You can find the ICQ setup instructions here: <a target="_blank" href="https://github.com/mk6i/retro-aim-server/blob/main/docs/CLIENT_ICQ.md" class="underline hover:text-purple-400">ICQ Setup</a>
                </p>
                <!-- ICQ Password Update Form -->
                <h2 class="text-xl font-semibold text-purple-400 mb-2 mt-6">Update ICQ Password</h2>
                <form method="POST" action="{{ route('dashboard.icq.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="new_icq_password" class="block text-purple-300 text-sm font-bold mb-1">
                            New ICQ Password
                        </label>
                        <input type="password" id="new_icq_password" name="new_password" required minlength="6" maxlength="8"
                               title="Password must be between 6 and 8 characters."
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                    </div>
                    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        Update Password
                    </button>
                </form>
                <!-- ICQ Delete Button -->
                <button type="button" class="delete-account-btn text-red-500 hover:text-red-400 mt-4"
                        data-delete-url="{{ route('dashboard.icq.destroy') }}">
                    Delete ICQ Account
                </button>
            @else
                <h2 class="text-2xl font-semibold text-purple-400 mb-2">Your ICQ Details</h2>
                <p class="text-white mb-6">You have not yet registered for ICQ. Please register below.</p>
                <form method="POST" action="{{ route('dashboard.icq.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block text-purple-300 text-sm font-bold mb-1">ICQ Username</label>
                        <input type="text" id="username" name="username" placeholder="This will be auto-generated for you" disabled
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-purple-300 text-sm font-bold mb-1">ICQ Password (6-8 Characters long)</label>
                        <input type="password" id="password" name="password" required minlength="6" maxlength="8"
                               title="Password must be between 6 and 8 characters."
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                    </div>
                    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        Register ICQ Account
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="bg-gray-800 p-6 rounded shadow-lg relative z-10 w-full max-w-md">
            <h2 class="text-xl font-bold text-red-500 mb-4">Confirm Account Deletion</h2>
            <p class="text-purple-300 mb-6">
                Are you sure you want to delete this account? This action cannot be undone.
            </p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDeleteBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-account-btn');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            const deleteForm = document.getElementById('deleteForm');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-delete-url');
                    deleteForm.setAttribute('action', url);
                    deleteModal.style.display = 'flex';
                });
            });

            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.style.display = 'none';
            });

            // Hide modal if clicking outside the modal content
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    deleteModal.style.display = 'none';
                }
            });
        });
    </script>
@endsection
