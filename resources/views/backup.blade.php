<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Spot</title>
    </head>
    <body class="antialiased">
        <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
            @foreach ($tracks as $track) 
                @if(!empty($track['items']))
                    @foreach ($track['items'] as $item)
                        {{-- @if(!empty($item['album']))
                            @foreach ($item['album'] as $album)
                                @if(!empty($album['images']))
                                    @foreach ($album['images'] as $image)
                                        <div class="w-full h-64 bg-gray-300 bg-center bg-cover rounded-lg shadow-md" style="background-image: url(https://images.unsplash.com/photo-1521903062400-b80f2cb8cb9d?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1050&q=80)"></div>
                                        @endforeach
                                    @endif
                            @endforeach
                        @endif --}}
                        <div class="w-full h-64 bg-gray-300 bg-center bg-cover rounded-lg shadow-md" style="background-image: url(https://images.unsplash.com/photo-1521903062400-b80f2cb8cb9d?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1050&q=80)"></div>
                        <div class="w-80 mt-5 overflow-hidden bg-white rounded-lg shadow-lg md:w-full dark:bg-gray-800">
                            <h3 class="py-2 font-bold tracking-wide text-center text-gray-800 uppercase dark:text-white">{{ $item['name'] }}</h3>
                            
                            <div class="flex items-center justify-between px-3 py-2 bg-gray-200 dark:bg-gray-700">
                                    @foreach ($item['artists'] as $artist)
                                        <span class="font-bold text-gray-800 dark:text-gray-200">{{ $artist['name'] }}</span>
                                    @endforeach
                                <a class="px-2 py-1 text-xs font-semibold text-white uppercase transition-colors duration-200 transform bg-gray-800 rounded hover:bg-gray-700 dark:hover:bg-gray-600 focus:bg-gray-700 dark:focus:bg-gray-600 focus:outline-none" target="_blank" href="{{ $item['preview_url'] }}">Preview Song</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </body>
</html>
