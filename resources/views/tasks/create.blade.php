@extends('layouts.app')

@section('title', 'New Task')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('projects.show', $project) }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to {{ $project->name }}</a>
            <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">New Task</h1>
        </div>

        <x-card class="p-6 sm:p-8">
            <form method="POST" action="{{ route('tasks.store', $project) }}">
                @csrf
                @include('tasks._form')

                <div class="mt-6 flex items-center justify-end gap-3">
                    <x-button href="{{ route('projects.show', $project) }}" variant="secondary">Cancel</x-button>
                    <x-button type="submit">Create Task</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
