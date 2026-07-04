@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <div class="mx-auto mt-10 max-w-md">
        <div class="mb-8 text-center">
            <a href="{{ url('/') }}" class="text-2xl font-semibold tracking-tight text-indigo-600">✓ Task Manager</a>
            <p class="mt-2 text-sm text-gray-500">Sign in to your account</p>
        </div>

        <x-card class="p-6 sm:p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <x-input name="email" label="Email" type="email" required autofocus />
                <x-input name="password" label="Password" type="password" required />

                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    Remember me
                </label>

                <x-button type="submit" class="w-full">Log in</x-button>
            </form>
        </x-card>

        <p class="mt-6 text-center text-sm text-gray-500">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Register</a>
        </p>
    </div>
@endsection
