<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-10">

        <h1 class="mb-8 text-4xl font-normal text-gray-900">
            {{ __('tasks.edit_task') }}
        </h1>

        <div class="max-w-xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

            {{ html()
                ->modelForm($task, 'PATCH', route('tasks.update', $task))
                ->open()
            }}

                <div class="mb-5">
                    {{ html()
                        ->label(__('tasks.name'), 'name')
                        ->class('mb-2 block text-sm font-medium text-gray-700')
                    }}

                    {{ html()
                        ->input('text', 'name')
                        ->class(
                            'block w-full rounded-md border-gray-300 ' .
                            'shadow-sm focus:border-blue-500 focus:ring-blue-500'
                        )
                    }}

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    {{ html()
                        ->label(__('tasks.description'), 'description')
                        ->class('mb-2 block text-sm font-medium text-gray-700')
                    }}

                    {{ html()
                        ->textarea('description')
                        ->class(
                            'block min-h-32 w-full rounded-md border-gray-300 ' .
                            'shadow-sm focus:border-blue-500 focus:ring-blue-500'
                        )
                    }}

                    @error('description')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label
                        for="status_id"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        {{ __('tasks.status') }}
                    </label>

                    <select
                        id="status_id"
                        name="status_id"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                        @foreach ($taskStatuses as $status)
                            <option
                                value="{{ $status->id }}"
                                @selected(old('status_id', $task->status_id) == $status->id)
                            >
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('status_id')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label
                        for="assigned_to_id"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        {{ __('tasks.assignee') }}
                    </label>

                    <select
                        id="assigned_to_id"
                        name="assigned_to_id"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                        <option value=""></option>

                        @foreach ($users as $user)
                            <option
                                value="{{ $user->id }}"
                                @selected(old('assigned_to_id', $task->assigned_to_id) == $user->id)
                            >
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('assigned_to_id')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label
                        for="labels"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        {{ __('tasks.labels') }}
                    </label>

                    <select
                        id="labels"
                        name="labels[]"
                        multiple
                        class="block min-h-32 w-full rounded-md border-gray-300 bg-white shadow-sm"
                    >
                        @foreach ($labels as $label)
                            <option
                                value="{{ $label->id }}"
                                @selected(in_array($label->id, $selectedLabels))
                            >
                                {{ $label->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{ html()
                    ->submit(__('tasks.update'))
                    ->class(
                        'rounded bg-blue-500 px-4 py-2 text-sm font-medium ' .
                        'text-white hover:bg-blue-600'
                    )
                }}

            {{ html()->closeModelForm() }}

        </div>
    </div>
</x-app-layout>