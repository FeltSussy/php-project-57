<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-10">

        <h1 class="mb-8 text-4xl font-normal text-gray-900">
            {{ __('labels.title') }}
        </h1>

        @can('create', App\Models\Label::class)
            <a
                href="{{ route('labels.create') }}"
                class="mb-4 inline-block rounded bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600"
            >
                {{ __('labels.create') }}
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
                            {{ __('labels.name') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('labels.description') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('labels.created_at') }}
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                            {{ __('labels.actions') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($labels as $label)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ $label->id }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-900">
                                <a
                                    href="{{ route('labels.show', $label) }}"
                                    class="text-blue-500 hover:text-blue-700"
                                >
                                    {{ $label->name }}
                                </a>
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ $label->description }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ $label->created_at?->format('d.m.Y') }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <div class="flex gap-4">

                                    @can('delete', $label)
                                        {{
                                            html()->form('DELETE', route('labels.destroy', $label))
                                                ->attribute(
                                                    'onsubmit',
                                                    'return confirm(' . Js::from(__('labels.confirm_delete')) . ')'
                                                )
                                                ->open()
                                        }}

                                        {{
                                            html()->a(
                                                route('labels.destroy', $label),
                                                __('labels.delete')
                                            )
                                            ->attribute(
                                                'onclick',
                                                "event.preventDefault(); this.closest('form').requestSubmit();"
                                            )
                                            ->class('text-red-500 hover:text-red-700')
                                        }}

                                        {{ html()->form()->close() }}
                                    @endcan

                                    @can('update', $label)
                                        <a
                                            href="{{ route('labels.edit', $label) }}"
                                            class="text-blue-500 hover:text-blue-700"
                                        >
                                            {{ __('labels.edit') }}
                                        </a>
                                    @endcan

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $labels->links() }}
        </div>

    </div>
</x-app-layout>