@php($task = $task ?? null)

<div class="space-y-5">
    <x-input name="title" label="Title" :value="$task?->title" required />
    <x-textarea name="description" label="Description" :value="$task?->description" rows="3" />
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <x-select
            name="status"
            label="Status"
            :selected="$task?->status ?? 'todo'"
            :options="['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done']"
            required
        />
        <x-input
            name="due_date"
            label="Due date"
            type="date"
            :value="$task?->due_date?->toDateString()"
        />
    </div>
</div>
