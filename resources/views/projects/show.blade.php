@extends('layouts.app')

@section('title', $project->name)

@section('content')
    <div class="mb-6">
        <a href="{{ route('projects.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to projects</a>
    </div>

    {{-- Project header --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-semibold tracking-tight text-gray-900">{{ $project->name }}</h1>
                <x-status-badge :status="$project->status" />
            </div>
            @if ($project->description)
                <p class="mt-2 max-w-2xl text-sm text-gray-600">{{ $project->description }}</p>
            @endif
        </div>
        <div class="flex items-center gap-2">
            <x-button href="{{ route('projects.edit', $project) }}" variant="secondary">Edit</x-button>
            <form method="POST" action="{{ route('projects.destroy', $project) }}"
                  onsubmit="return confirm('Delete this project and all its tasks?');">
                @csrf
                @method('DELETE')
                <x-button type="submit" variant="danger">Delete</x-button>
            </form>
        </div>
    </div>

    {{-- Tasks --}}
    <x-card>
        <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4">
            <h2 class="font-medium text-gray-900">Tasks ({{ $project->tasks->count() }})</h2>
            <x-button href="{{ route('tasks.create', $project) }}">+ Add Task</x-button>
        </div>

        @if ($project->tasks->isEmpty())
            <p class="px-5 py-10 text-center text-sm text-gray-400">No tasks yet. Add your first one.</p>
        @else
            <ul class="divide-y divide-gray-100">
                @foreach ($project->tasks as $task)
                    <li class="flex items-center justify-between gap-4 px-5 py-4">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="truncate font-medium text-gray-800">{{ $task->title }}</span>
                                <x-status-badge :status="$task->status" />
                            </div>
                            @if ($task->description)
                                <p class="mt-0.5 truncate text-sm text-gray-500">{{ $task->description }}</p>
                            @endif
                            @if ($task->due_date)
                                <p class="mt-0.5 text-xs text-gray-400">Due {{ $task->due_date->format('M j, Y') }}</p>
                            @endif
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Edit</a>
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                  onsubmit="return confirm('Delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-500">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </x-card>
@endsection
