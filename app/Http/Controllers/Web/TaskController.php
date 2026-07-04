<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function create(Project $project): View
    {
        $this->authorize('update', $project);

        return view('tasks.create', ['project' => $project]);
    }

    public function store(Request $request, Project $project): RedirectResponse
    {
        $this->authorize('update', $project);

        $data = $this->validateData($request);

        $task = $project->tasks()->make($data);
        $task->user_id = $request->user()->id;
        $task->save();

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->update($this->validateData($request));

        return redirect()
            ->route('projects.show', $task->project_id)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $projectId = $task->project_id;
        $task->delete();

        return redirect()
            ->route('projects.show', $projectId)
            ->with('success', 'Task deleted successfully.');
    }

    /**
     * Shared validation rules for store/update.
     *
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:todo,in_progress,done'],
            'due_date' => ['nullable', 'date'],
        ]);
    }
}
