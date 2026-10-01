<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate();

        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Label::class);

        $label = new Label;

        return view('label.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Label::class);

        $data = $request->validate(
            [
                'name' => 'required|unique:labels',
                'description' => 'nullable',
            ],
            [
                'name.unique' => __('labels.validation.unique')
            ],
            [
                'name' => __('labels.attributes.name'),
            ]
    );

        $label = new Label;

        $label->fill($data);
        $label->save();

        flash(__('labels.created'))->success();

        return redirect()->route('labels.show', $label);
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        return view('label.show', compact('label'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        Gate::authorize('update', $label);

        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        Gate::authorize('update', $label);

        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $label->fill($data);
        $label->save();

        flash(__('labels.updated'))->success();

        return redirect()->route('labels.show', $label);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        Gate::authorize('delete', $label);

        $isAssigned = $label->tasks()->exists();

        if (! $isAssigned) {
            $label->delete();
            flash(__('labels.deleted'))->success();
        } else {
            flash(__('labels.cannot_delete'))->error();
        }

        return redirect()->route('labels.index');
    }
}
