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
                <label for="password" class="block text-purple-300 text-sm font-bold mb-2">New Password <span class="text-xs font-normal">(leave blank if unchanged)</span></label>
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
            <div class="flex items-center justify-end">
                <button type="submit"
                        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
@endsection
