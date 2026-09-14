<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('task_statuses.create_status') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl px-6 py-10">
        <div class="rounded-lg bg-white p-8 shadow-sm">

            {{ html()
                ->modelForm($taskStatus, 'POST', route('task_statuses.store'))
                ->class('max-w-xl')
                ->open()
            }}

                <div>
                    {{ html()
                        ->label(__('task_statuses.name'), 'name')
                        ->class('block text-sm font-medium text-gray-700')
                    }}

                    {{ html()
                        ->input('text', 'name')
                        ->class('mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500')
                    }}

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-6">
                    {{ html()
                        ->submit(__('task_statuses.create'))
                        ->class(
                            'rounded bg-blue-500 px-4 py-2 text-sm ' .
                            'font-medium text-white hover:bg-blue-600'
                        )
                    }}
                </div>

            {{ html()->closeModelForm() }}

        </div>
    </div>
</x-app-layout>
