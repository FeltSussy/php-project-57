<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-10">

        <h1 class="mb-8 text-4xl font-normal text-gray-900">
            {{ __('tasks.title') }}
        </h1>

        {{ html()
            ->form('GET', route('tasks.index'))
            ->class('mb-4 flex items-center gap-2')
            ->open()
        }}

        {{ html()
            ->select(
                'filter[status_id]',
                $taskStatuses->pluck('name', 'id'),
                request('filter.status_id')
            )
            ->placeholder(__('tasks.status'))
            ->class(
                'w-40 rounded-md border-gray-300 text-sm shadow-sm ' .
                'focus:border-blue-500 focus:ring-blue-500'
            )
        }}

        {{ html()
            ->select(
                'filter[created_by_id]',
                $users->pluck('name', 'id'),
                request('filter.created_by_id')
            )
            ->placeholder(__('tasks.author'))
            ->class(
                'w-64 rounded-md border-gray-300 text-sm shadow-sm ' .
                'focus:border-blue-500 focus:ring-blue-500'
            )
        }}

        {{ html()
            ->select(
                'filter[assigned_to_id]',
                $users->pluck('name', 'id'),
                request('filter.assigned_to_id')
            )
            ->placeholder(__('tasks.assignee'))
            ->class(
                'w-64 rounded-md border-gray-300 text-sm shadow-sm ' .
                'focus:border-blue-500 focus:ring-blue-500'
            )
        }}

        {{ html()
            ->select(
                'filter[labels.id]',
                $labels->pluck('name', 'id'),
                request('filter')['labels.id'] ?? null
            )
            ->placeholder(__('tasks.label'))
            ->class(
                'w-52 rounded-md border-gray-300 text-sm shadow-sm ' .
                'focus:border-blue-500 focus:ring-blue-500'
            )
        }}

        {{ html()
            ->submit(__('tasks.apply'))
            ->class(
                'rounded bg-blue-500 px-4 py-2 text-sm font-medium ' .
                'text-white hover:bg-blue-600'
            )
        }}

        <a
            href="{{ route('tasks.index') }}"
            class="rounded border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50"
        >
            {{ __('tasks.reset') }}
        </a>

        {{ html()->form()->close() }}

        <div class="mb-4 flex items-center justify-between gap-4">

            @can('create', App\Models\Task::class)
                <a
                    href="{{ route('tasks.create') }}"
                    class="shrink-0 rounded bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600"
                >
                    {{ __('tasks.create') }}
                </a>
            @endcan
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            ID
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('tasks.status') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('tasks.name') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('tasks.author') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('tasks.assignee') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('tasks.created_at') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('tasks.actions') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ $task->id }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $task->status->name }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <a
                                    href="{{ route('tasks.show', $task) }}"
                                    class="text-blue-500 hover:text-blue-700"
                                >
                                    {{ $task->name }}
                                </a>
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $task->creator->name }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $task->assignee?->name }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ $task->created_at->format('d.m.Y') }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <div class="flex gap-4">
                                    @can('update', $task)
                                        <a
                                            href="{{ route('tasks.edit', $task) }}"
                                            class="text-blue-500 hover:text-blue-700"
                                        >
                                            {{ __('tasks.edit') }}
                                        </a>
                                    @endcan

                                    @can('delete', $task)
                                        <form
                                            method="POST"
                                            action="{{ route('tasks.destroy', $task) }}"
                                            data-confirm="{{ __('tasks.confirm_delete') }}"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-red-500 hover:text-red-700"
                                            >
                                                {{ __('tasks.delete') }}
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>