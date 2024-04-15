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
    {{-- No body uso um grid e uma classe "place-content-center" para centrar a div na vertical e horizontal--}}
    <body class="grid w-full h-screen font-sans antialiased bg-violet-500 place-content-center">
        <div class="px-6 py-4 overflow-hidden bg-white rounded-lg shadow-md w-96">
            {{ $slot }}
        </div>
    </body>
</html>
