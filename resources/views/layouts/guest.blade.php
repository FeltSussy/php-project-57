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
        <main class="flex min-h-screen items-center justify-center bg-gray-100 px-4 py-8">
            <div class="w-full max-w-md overflow-hidden rounded-lg bg-white px-6 py-5 shadow-md sm:px-6">
                <a href="{{ url('/') }}" class="mb-2 block text-center text-3xl font-normal text-gray-900">
                    Менеджер задач
                </a>

                {{ $slot }}
            </div>
        </main>
    </body>
</html>
