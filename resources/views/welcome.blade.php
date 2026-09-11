<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Менеджер задач</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen bg-gray-50">
            @include('layouts.navigation')

            <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <h1 class="text-5xl font-medium leading-tight text-black sm:text-6xl">Привет от Хекслета!</h1>
                <p class="mt-3 text-xl text-gray-500">Это простой менеджер задач на Laravel</p>
                <button type="button" class="mt-8 rounded border border-gray-400 bg-white px-4 py-2 text-base font-semibold text-gray-800 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Нажми меня
                </button>
            </main>
        </div>
    </body>
</html>
