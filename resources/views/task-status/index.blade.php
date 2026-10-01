<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-normal text-gray-900">
            {{ __('task_statuses.title') }}
        </h2>
    </x-slot>
    <div class="mx-auto max-w-7xl px-6">
        @can('create', App\Models\TaskStatus::class)
        <a
        href="{{ route('task_statuses.create') }}"
        class="mb-4 inline-block rounded bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600"
        >
            {{ __('task_statuses.create_status') }}
        </a>
        @endcan
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            ID
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('task_statuses.name') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('task_statuses.creation_date') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('task_statuses.actions') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($taskStatuses as $status)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ $status->id }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $status->name }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ $status->created_at }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <div class="flex gap-4">
                                    @can('delete', $status)
                                    {{
                                        html()->form('DELETE', route('task_statuses.destroy', $status))
                                            ->attribute('data-confirm', __('task_statuses.confirm_delete'))
                                            ->open()
                                    }}

                                    {{
                                        html()->button(__('task_statuses.delete'), 'submit')
                                            ->class('text-red-500 hover:text-red-700')
                                    }}

                                    {{ html()->form()->close() }}
                                    @endcan
                                    @can('update', $status)
                                    {{ html()->form('GET', route('task_statuses.edit', $status))->open() }}

                                        {{ html()->button(__('task_statuses.edit'), 'submit')
                                            ->class('text-blue-500 hover:text-blue-700') }}

                                    {{ html()->form()->close() }}
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $taskStatuses->links() }}
    </div>
</x-app-layout>
