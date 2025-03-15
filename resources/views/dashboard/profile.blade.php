@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
    <div class="bg-gray-800 p-6 rounded shadow-md">
        <h1 class="text-3xl font-bold text-purple-500 mb-4">Profile</h1>
        <p class="mb-4">Update your email and password. Note that your name cannot be changed.</p>
        <form method="POST" action="{{ route('dashboard.profile.update') }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="email" class="block text-purple-300 text-sm font-bold mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                @error('email')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-purple-300 text-sm font-bold mb-2">
                    New Password <span class="text-xs font-normal">(leave blank if unchanged)</span>
                </label>
                <input id="password" type="password" name="password"
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                @error('password')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-purple-300 text-sm font-bold mb-2">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Profile
                </button>
            </div>
        </form>

        <!-- Fancy Delete Confirmation Modal using Plain JavaScript -->
        <div class="mt-6 border-t border-gray-700 pt-6">
            <button id="openDeleteModalBtn"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Delete Account
            </button>

            <!-- Modal Overlay -->
            <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <!-- Modal Content -->
                <div class="bg-gray-800 p-6 rounded shadow-lg relative z-10 w-full max-w-md">
                    <h2 class="text-xl font-bold text-red-500 mb-4">Confirm Account Deletion</h2>
                    <p class="text-purple-300 mb-6">
                        Are you sure you want to delete your account? This action is irreversible.
                    </p>
                    <p class="text-purple-300 mb-6">
                        Deleting your account here will also delete your account on retro-aim-server.
                    </p>
                    <div class="flex justify-end space-x-4">
                        <button id="cancelDeleteBtn"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cancel
                        </button>
                        <form method="POST" action="{{ route('dashboard.profile.destroy') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Delete Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openDeleteModalBtn = document.getElementById('openDeleteModalBtn');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            const deleteModal = document.getElementById('deleteModal');

            // Show the modal when the delete button is clicked
            openDeleteModalBtn.addEventListener('click', function() {
                deleteModal.style.display = 'flex';
            });

            // Hide the modal when the cancel button is clicked
            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.style.display = 'none';
            });

            // Hide the modal if clicking outside the modal content
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    deleteModal.style.display = 'none';
                }
            });
        });
    </script>
@endsection
