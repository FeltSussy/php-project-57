<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 py-10">

        <div class="mb-8 flex items-center gap-4">
            <h1 class="text-4xl font-normal text-gray-900">
                {{ __('labels.show') }}: {{ $label->name }}
            </h1>

            @can('update', $label)
                <a
                    href="{{ route('labels.edit', $label) }}"
                    class="text-blue-500 hover:text-blue-700"
                >
                    {{ __('labels.edit') }}
                </a>
            @endcan

            @can('delete', $label)
                <form
                    method="POST"
                    action="{{ route('labels.destroy', $label) }}"
                    data-confirm="{{ __('labels.confirm_delete') }}"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="text-red-500 hover:text-red-700"
                    >
                        {{ __('labels.delete') }}
                    </button>
                </form>
            @endcan
        </div>

        <div class="max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <div class="space-y-3 text-sm text-gray-800">

                <p>
                    <span class="font-semibold">
                        {{ __('labels.name') }}:
                    </span>

                    {{ $label->name }}
                </p>

                <p>
                    <span class="font-semibold">
                        {{ __('labels.description') }}:
                    </span>

                    {{ $label->description }}
                </p>

            </div>
        </div>

    </div>
</x-app-layout>