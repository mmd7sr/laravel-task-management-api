<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
public function index(Request $request)
{

    $projects = Project::where('user_id', auth()->id())
        ->when($request->status, function ($query, $status) {
            $query->where('status', $status);
        })
        ->when($request->search, function ($query, $search) {
            $query->where('name', 'like', "%$search%");
        })
        ->get();

    return response()->json($projects);
}


    public function store(StoreProjectRequest $request)
    {
        $project = auth()->user()->projects()->create($request->validated());

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Project $project)
    {
        $this->authorizeProject($project);

        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorizeProject($project);

        $project->update($request->validated());

        return new ProjectResource($project);
    }

    public function destroy(Project $project): JsonResponse
    {
        $this->authorizeProject($project);

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully.',
        ]);
    }

    private function authorizeProject(Project $project): void
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'This action is unauthorized.');
        }
    }
}
