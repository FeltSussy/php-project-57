<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

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
            )
            ->with(
                'status',
                'createdBy',
                'assignedTo',
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
    public function store(StoreTaskRequest $request)
    {
        $task = $request->user()->createdTasks()->create(
            $request->safe()->except('labels')
        );

        $task->labels()->sync(
            $request->validated('labels', [])
        );

        flash(__('tasks.created'))->success();

        return redirect()->route('tasks.index');
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
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        $assignedLabels = $task->labels->pluck('id')->all();
        $selectedLabels = session()->hasOldInput()
            ? old('labels', [])
            : $assignedLabels;

        return view('task.edit', [
            'task' => $task,
            'taskStatuses' => $taskStatuses,
            'users' => $users,
            'labels' => $labels,
            'selectedLabels' => $selectedLabels,
            'assignedLabels' => $assignedLabels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update(
            $request->safe()->except('labels')
        );

        $task->labels()->sync(
            $request->validated('labels', [])
        );

        flash(__('tasks.updated'))->success();

        return redirect()->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        flash(__('tasks.deleted'))->success();

        return redirect()->route('tasks.index');
    }
}
