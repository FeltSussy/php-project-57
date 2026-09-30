<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters(
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
                AllowedFilter::exact('labels.id'),
            )
            ->paginate()
            ->withQueryString();

        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('task.index', [
            'tasks' => $tasks,
            'taskStatuses' => $taskStatuses,
            'users' => $users,
            'labels' => $labels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Task::class);

        $task = new Task;
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('task.create', [
            'task' => $task,
            'taskStatuses' => $taskStatuses,
            'users' => $users,
            'labels' => $labels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Task::class);

        $data = $request->validate([
            'name' => 'required',
            'status_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable',
        ]);

        $task = new Task;
        $creatorId = Auth::id();
        $task->created_by_id = $creatorId;

        $task->fill($data);
        $task->save();

        if ($labels = $request->input('labels')) {
            $task->labels()->sync($labels);
        }

        flash(__('tasks.created'))->success();

        return redirect()->route('tasks.show', $task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize('update', $task);

        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        $selectedLabels = $task->labels->pluck('id')->all();

        return view('task.edit', [
            'task' => $task,
            'taskStatuses' => $taskStatuses,
            'users' => $users,
            'labels' => $labels,
            'selectedLabels' => $selectedLabels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        Gate::authorize('update', $task);

        $data = $request->validate([
            'name' => 'required',
            'status_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable',
        ]);

        $labels = $request->input('labels');

        $task->fill($data);
        $task->save();

        $task->labels()->sync($labels);

        return redirect()->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
