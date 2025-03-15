@extends('layouts.admin')

@section('title', 'Dashboard Home')

@section('content')
    <div class="bg-gray-800 p-6 rounded shadow-md">
        <h1 class="text-3xl font-bold text-purple-500 mb-4">{{ config('app.name') }}</h1>
        <p class="mb-4">
            Welcome to your dashboard. Below are the instructions for connecting to the retro-aim-server using the aim client.
        </p>
        <div class="bg-gray-700 p-4 rounded">
            <h2 class="text-2xl font-semibold text-purple-400 mb-2">Connection Instructions</h2>
            <ol class="list-decimal list-inside text-purple-300">
                <li>Open the aim client.</li>
                <li>Navigate to Setup, then press the Connection button.</li>
                <li>Set the host to <span class="font-bold">{{ config('ras.public_uri') }}</span>.</li>
                <li>Enter your username and the password you registered with.</li>
                <li>Click connect.</li>
            </ol>
        </div>
    </div>
@endsection
