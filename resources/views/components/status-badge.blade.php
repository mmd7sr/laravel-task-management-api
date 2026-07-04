@props(['status'])

@php
    $styles = [
        // Project statuses
        'active' => 'bg-green-100 text-green-800',
        'completed' => 'bg-blue-100 text-blue-800',
        'archived' => 'bg-gray-100 text-gray-600',
        // Task statuses
        'todo' => 'bg-gray-100 text-gray-700',
        'in_progress' => 'bg-amber-100 text-amber-800',
        'done' => 'bg-green-100 text-green-800',
    ];
    $class = $styles[$status] ?? 'bg-gray-100 text-gray-700';
    $label = ucfirst(str_replace('_', ' ', $status));
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {$class}"]) }}>
    {{ $label }}
</span>
