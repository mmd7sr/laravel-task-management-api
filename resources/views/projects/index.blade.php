@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Projects</h1>
        <x-button href="{{ route('projects.create') }}">+ New Project</x-button>
    </div>

    {{-- Search / filter --}}
    <form method="GET" action="{{ route('projects.index') }}" class="mb-6 flex flex-col gap-3 sm:flex-row">
        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Search projects…"
            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:max-w-xs"
        >
        <select
            name="status"
            class="rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
            <option value="">All statuses</option>
            @foreach (['active' => 'Active', 'completed' => 'Completed', 'archived' => 'Archived'] as $val => $label)
                <option value="{{ $val }}" @selected($status === $val)>{{ $label }}</option>
            @endforeach
        </select>
        <x-button type="submit" variant="secondary">Filter</x-button>
    </form>

    @if ($projects->isEmpty())
        <x-card class="p-12 text-center">
            <p class="text-sm text-gray-500">No projects found.</p>
            <div class="mt-4">
                <x-button href="{{ route('projects.create') }}">Create your first project</x-button>
            </div>
        </x-card>
    @else
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $project)
                <x-card class="flex flex-col p-5">
                    <div class="mb-2 flex items-start justify-between gap-2">
                        <a href="{{ route('projects.show', $project) }}" class="font-medium text-gray-900 hover:text-indigo-600">
                            {{ $project->name }}
                        </a>
                        <x-status-badge :status="$project->status" />
                    </div>
                    <p class="line-clamp-2 flex-1 text-sm text-gray-500">
                        {{ $project->description ?: 'No description.' }}
                    </p>
                    <div class="mt-4 flex items-center justify-between text-xs text-gray-400">
                        <span>{{ $project->created_at->format('M j, Y') }}</span>
                        <a href="{{ route('projects.show', $project) }}" class="font-medium text-indigo-600 hover:text-indigo-500">Open →</a>
                    </div>
                </x-card>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $projects->links() }}
        </div>
    @endif
@endsection
