@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">Welcome back, {{ auth()->user()->name }}.</p>
        </div>
        <x-button href="{{ route('projects.create') }}">+ New Project</x-button>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <x-card class="p-5">
            <p class="text-sm font-medium text-gray-500">Projects</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $projectCount }}</p>
        </x-card>
        <x-card class="p-5">
            <p class="text-sm font-medium text-gray-500">Total Tasks</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $taskCount }}</p>
        </x-card>
        <x-card class="p-5">
            <p class="text-sm font-medium text-gray-500">Open Tasks</p>
            <p class="mt-2 text-3xl font-semibold text-indigo-600">{{ $openTaskCount }}</p>
        </x-card>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
        {{-- Recent projects --}}
        <x-card>
            <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4">
                <h2 class="font-medium text-gray-900">Recent Projects</h2>
                <a href="{{ route('projects.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @forelse ($recentProjects as $project)
                    <li class="flex items-center justify-between px-5 py-3">
                        <a href="{{ route('projects.show', $project) }}" class="text-sm font-medium text-gray-800 hover:text-indigo-600">
                            {{ $project->name }}
                        </a>
                        <x-status-badge :status="$project->status" />
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-gray-400">No projects yet.</li>
                @endforelse
            </ul>
        </x-card>

        {{-- Recent tasks --}}
        <x-card>
            <div class="border-b border-gray-200 px-5 py-4">
                <h2 class="font-medium text-gray-900">Recent Tasks</h2>
            </div>
            <ul class="divide-y divide-gray-100">
                @forelse ($recentTasks as $task)
                    <li class="flex items-center justify-between px-5 py-3">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-gray-800">{{ $task->title }}</p>
                            <p class="truncate text-xs text-gray-400">{{ $task->project?->name }}</p>
                        </div>
                        <x-status-badge :status="$task->status" />
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-gray-400">No tasks yet.</li>
                @endforelse
            </ul>
        </x-card>
    </div>
@endsection
