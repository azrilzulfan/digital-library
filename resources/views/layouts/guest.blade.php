<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-100 text-gray-900 antialiased">
        <div class="container h-screen p-20">
            <div class="container w-3/4 flex mx-auto shadow">
                <div class="w-[65%] bg-gray-100">

                </div>

                <div class="w-[35%] p-10 bg-white">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
