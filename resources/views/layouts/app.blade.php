<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Search songs available through spotify" />
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🔥</text></svg>">
        <link rel="alternate icon" href="/favicon.ico">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @livewireStyles
        <script src="//unpkg.com/alpinejs" defer></script>
        <title>Spot Search</title>
    </head>
    <body class="antialiased font-optima bg-secondary text-offblack">
        <div class="conent-main">
            @include('layouts.nav')
            @yield('content')
        </div>
        @include('layouts.footer')
        @livewireScripts
    </body>
</html>
