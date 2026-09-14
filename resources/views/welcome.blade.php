<x-app-layout>
    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="text-5xl font-medium leading-tight text-black sm:text-6xl">{{ __('welcome.hello') }}</h1>
        <p class="mt-3 text-xl text-gray-500">{{ __('welcome.description') }}</p>
        <button type="button" class="mt-8 rounded border border-gray-400 bg-white px-4 py-2 text-base font-semibold text-gray-800 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            {{ __('welcome.click_me') }}
        </button>
    </main>
</x-app-layout>
