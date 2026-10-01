<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::paginate();

        return view('task-status.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', TaskStatus::class);

        $taskStatus = new TaskStatus;

        return view('task-status.create', compact('taskStatus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', TaskStatus::class);

        $data = $request->validate(
            [
                'name' => 'required|unique:task_statuses',
            ],
            [
                'name.unique' => __('task_statuses.validation.name_unique'),
            ]);

        $taskStatus = new TaskStatus;

        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('task_statuses.created'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, TaskStatus $taskStatus)
    {
        Gate::authorize('update', $taskStatus);

        return view('task-status.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        Gate::authorize('update', $taskStatus);

        $data = $request->validate(
            [
                'name' => "required|unique:task_statuses,name,{$taskStatus->id}",
            ],
            [
                'name.unique' => __('task_statuses.validation.name_unique'),
            ]);

        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('task_statuses.updated'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        Gate::authorize('delete', $taskStatus);

        $isAssigned = $taskStatus->tasks()->exists();

        if (! $isAssigned) {
            $taskStatus->delete();
            flash(__('task_statuses.deleted'))->success();
        } else {
            flash(__('task_statuses.cannot_delete'))->error();
        }

        return redirect()->route('task_statuses.index');
    }
}
