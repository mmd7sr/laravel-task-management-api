<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $projects = $user->projects();
        $tasks = Task::where('user_id', $user->id);

        return view('dashboard', [
            'projectCount' => $projects->count(),
            'taskCount' => (clone $tasks)->count(),
            'openTaskCount' => (clone $tasks)->whereIn('status', ['todo', 'in_progress'])->count(),
            'recentProjects' => $user->projects()->latest()->take(5)->get(),
            'recentTasks' => (clone $tasks)->with('project')->latest()->take(5)->get(),
        ]);
    }
}
