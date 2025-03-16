@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="bg-gray-800 p-6 rounded shadow-md">
        <h1 class="text-3xl font-bold text-purple-500 mb-4">Edit User</h1>
        <form method="POST" action="{{ route('dashboard.admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-purple-300 text-sm font-bold mb-1">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                @error('name')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-purple-300 text-sm font-bold mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
                @error('email')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="is_admin" class="inline-flex items-center text-purple-300">
                    <input type="checkbox" id="is_admin" name="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                    class="form-checkbox text-purple-500">
                    <span class="ml-2">Administrator</span>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update User
                </button>
                <a href="{{ route('dashboard.admin.users.index') }}" class="text-purple-400 hover:text-purple-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
