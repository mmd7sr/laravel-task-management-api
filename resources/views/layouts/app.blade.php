<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Task Manager') — {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">
    @auth
        <nav class="border-b border-gray-200 bg-white">
            <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-tight text-indigo-600">
                        ✓ Task Manager
                    </a>
                    <div class="hidden items-center gap-1 sm:flex">
                        <a href="{{ route('dashboard') }}"
                           class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('projects.index') }}"
                           class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('projects.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
                            Projects
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="hidden text-sm text-gray-500 sm:inline">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-md px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100">
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6">
        <x-flash />
        @yield('content')
    </main>
</body>
</html>
