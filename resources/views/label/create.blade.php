<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-10">

        <h1 class="mb-8 text-4xl font-normal text-gray-900">
            {{ __('labels.create') }}
        </h1>

        <div class="max-w-xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm">

            {{ html()
                ->modelForm($label, 'POST', route('labels.store'))
                ->open()
            }}

                <div class="mb-5">
                    {{ html()
                        ->label(__('labels.name'), 'name')
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
                        ->label(__('labels.description'), 'description')
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

                {{ html()
                    ->submit(__('labels.create_button'))
                    ->class(
                        'rounded bg-blue-500 px-4 py-2 text-sm font-medium ' .
                        'text-white hover:bg-blue-600'
                    )
                }}

            {{ html()->closeModelForm() }}

        </div>
    </div>
</x-app-layout>