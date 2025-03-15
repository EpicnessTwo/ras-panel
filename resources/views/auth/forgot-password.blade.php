@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
    <h2 class="text-2xl font-bold text-center text-purple-500 mb-6">Reset Password</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-purple-300 text-sm font-bold mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-purple-500">
            @error('email')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <button type="submit"
                    class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Send Password Reset Link
            </button>
        </div>
    </form>
@endsection
