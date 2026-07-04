@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="mx-auto mt-10 max-w-md">
        <div class="mb-8 text-center">
            <a href="{{ url('/') }}" class="text-2xl font-semibold tracking-tight text-indigo-600">✓ Task Manager</a>
            <p class="mt-2 text-sm text-gray-500">Create your account</p>
        </div>

        <x-card class="p-6 sm:p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <x-input name="name" label="Name" required autofocus />
                <x-input name="email" label="Email" type="email" required />
                <x-input name="password" label="Password" type="password" required />
                <x-input name="password_confirmation" label="Confirm password" type="password" required />

                <x-button type="submit" class="w-full">Create account</x-button>
            </form>
        </x-card>

        <p class="mt-6 text-center text-sm text-gray-500">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Log in</a>
        </p>
    </div>
@endsection
