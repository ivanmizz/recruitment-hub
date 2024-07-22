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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[url('https://cdn.pixabay.com/photo/2019/03/13/22/44/dar-es-salaam-4053933_1280.jpg')] bg-cover h-screen w-full">
            <div>
                <a href="/">
                    {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-700" /> --}}
                    <h1 class="text-slate-900 hover:text-blue-900 text-3xl font-mono font-bold"> RECRUITMENT HUB</h1>
                </a>

            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg bg-blue-200 bg-opacity-70">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
