@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
    <div class="bg-gray-800 p-6 rounded shadow-md">
        <h1 class="text-3xl font-bold text-purple-500 mb-4">Manage Users</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-700">
                <thead>
                <tr>
                    <th class="py-3 px-4 uppercase text-sm text-left text-purple-300">ID</th>
                    <th class="py-3 px-4 uppercase text-sm text-left text-purple-300">Panel Name</th>
                    <th class="py-3 px-4 uppercase text-sm text-left text-purple-300">AIM Username</th>
                    <th class="py-3 px-4 uppercase text-sm text-left text-purple-300">ICQ Username</th>
                    <th class="py-3 px-4 uppercase text-sm text-right text-purple-300">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr class="border-b border-gray-600">
                        <td class="py-3 px-4">{{ $user->id }}</td>
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->aim?->name }}</td>
                        <td class="py-3 px-4">{{ $user->icq?->name }}</td>
                        <td class="py-3 px-4 text-right">
                            <a href="{{ route('dashboard.admin.users.edit', $user->id) }}" class="text-purple-400 hover:text-purple-300 mr-2">Edit</a>
                            @if ($user->id !== auth()->id() && !$user->is_admin)
                                <button type="button" data-delete-url="{{ route('dashboard.admin.users.destroy', $user->id) }}" class="delete-user-btn text-red-500 hover:text-red-400">
                                    Delete
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-3 px-4 text-center">No users found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Fancy Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="bg-gray-800 p-6 rounded shadow-lg relative z-10 w-full max-w-md">
            <h2 class="text-xl font-bold text-red-500 mb-4">Confirm User Deletion</h2>
            <p class="text-purple-300 mb-6">
                Are you sure you want to delete this user? This action cannot be undone.
            </p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDeleteBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-user-btn');
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
