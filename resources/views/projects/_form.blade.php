@php($project = $project ?? null)

<div class="space-y-5">
    <x-input name="name" label="Name" :value="$project?->name" required />
    <x-textarea name="description" label="Description" :value="$project?->description" />
    <x-select
        name="status"
        label="Status"
        :selected="$project?->status ?? 'active'"
        :options="['active' => 'Active', 'completed' => 'Completed', 'archived' => 'Archived']"
        required
    />
</div>
