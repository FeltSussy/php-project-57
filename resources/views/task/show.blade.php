<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-10">

        <div class="mb-8 flex items-center gap-3">
            <h1 class="text-4xl font-normal text-gray-900">
                {{ __('tasks.show') }}: {{ $task->name }}
            </h1>

            @can('update', $task)
                <a
                    href="{{ route('tasks.edit', $task) }}"
                    class="text-2xl text-gray-400 hover:text-gray-600"
                    title="{{ __('tasks.edit') }}"
                >
                    ⚙
                </a>
            @endcan
        </div>

        <div class="max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

            <div class="space-y-3 text-sm text-gray-800">

                <p>
                    <span class="font-semibold">
                        {{ __('tasks.name') }}:
                    </span>

                    {{ $task->name }}
                </p>

                <p>
                    <span class="font-semibold">
                        {{ __('tasks.status') }}:
                    </span>

                    {{ $task->status->name }}
                </p>

                <p>
                    <span class="font-semibold">
                        {{ __('tasks.description') }}:
                    </span>

                    {{ $task->description }}
                </p>

                <div>
                    <span class="font-semibold">
                        {{ __('tasks.labels') }}:
                    </span>

                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach ($task->labels as $label)
                            <p
                                class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-xs font-medium uppercase text-blue-600"
                            >
                                <span>🏷️</span>

                                {{ $label->name }}
                            </p>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>