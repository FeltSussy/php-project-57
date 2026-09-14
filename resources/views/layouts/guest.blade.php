<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('layouts.task_manager') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <main class="flex min-h-screen items-center justify-center bg-gray-100 px-4 py-8">
            <div class="w-full max-w-md overflow-hidden rounded-lg bg-white px-6 py-5 shadow-md sm:px-6">
                <a href="{{ url('/') }}" class="mb-2 block text-center text-3xl font-normal text-gray-900">
                    {{ __('layouts.task_manager') }}
                </a>

                {{ $slot }}
            </div>
        </main>
    </body>
</html>
