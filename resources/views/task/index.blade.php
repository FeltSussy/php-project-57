<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-10">

        <h1 class="mb-8 text-4xl font-normal text-gray-900">
            {{ __('tasks.title') }}
        </h1>

        <form
            method="GET"
            action="{{ route('tasks.index') }}"
            class="mb-4 flex items-center gap-2"
        >
            <select
                name="filter[status_id]"
                class="w-40 rounded-md border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
                <option value=""> {{ __('tasks.status') }} </option>

                @foreach ($taskStatuses as $status)
                    <option
                        value="{{ $status->id }}"
                        @selected(request('filter.status_id') == $status->id)
                    >
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>

            <select
                name="filter[created_by_id]"
                class="w-64 rounded-md border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">{{ __('tasks.author') }}</option>

                @foreach ($users as $user)
                    <option
                        value="{{ $user->id }}"
                        @selected(request('filter.created_by_id') == $user->id)
                    >
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <select
                name="filter[assigned_to_id]"
                class="w-64 rounded-md border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">{{ __('tasks.assignee') }}</option>

                @foreach ($users as $user)
                    <option
                        value="{{ $user->id }}"
                        @selected(request('filter.assigned_to_id') == $user->id)
                    >
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <select
                name="filter[labels.id]"
                class="w-52 rounded-md border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">{{ __('tasks.label') }}</option>

                @foreach ($labels as $label)
                    <option
                        value="{{ $label->id }}"
                        @selected(request('filter')['labels.id'] ?? null == $label->id)
                    >
                        {{ $label->name }}
                    </option>
                @endforeach
            </select>

            <button
                type="submit"
                class="rounded bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600"
            >
                {{ __('tasks.apply') }}
            </button>

            <a
                href="{{ route('tasks.index') }}"
                class="rounded border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50"
            >
                {{ __('tasks.reset') }}
            </a>
        </form>

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