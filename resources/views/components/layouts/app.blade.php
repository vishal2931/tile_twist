<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')
        <title>{{ $title ?? 'Tile Twist' }}</title>
    </head>
    <body class="bg-gradient-to-r from-blue-800 to-indigo-900 font-satisfy">
        <div class="fireworks absolute top-0 left-0 w-full h-full -z-10 overflow-hidden"></div>
        {{ $slot }}
        <script src="{{ asset('assets/js/easytimer.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/fireworks-js@2.x/dist/index.umd.js"></script>
    </body>
</html>
