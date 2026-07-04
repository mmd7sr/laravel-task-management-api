@props(['name', 'label', 'options' => [], 'selected' => null, 'required' => false])

<div>
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium text-gray-700">
        {{ $label }}@if ($required)<span class="text-red-500">*</span>@endif
    </label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @if ($required) required @endif
        {{ $attributes->merge(['class' => 'block w-full rounded-md border px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 ' . ($errors->has($name) ? 'border-red-400' : 'border-gray-300')]) }}
    >
        @foreach ($options as $optValue => $optLabel)
            <option value="{{ $optValue }}" @selected(old($name, $selected) === $optValue)>{{ $optLabel }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
