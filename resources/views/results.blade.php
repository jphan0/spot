<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Spot</title>
    </head>
    <body class="antialiased">
        <div class="flex items-center justify-center my-48">
            <div class="grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($tracks as $track) 
                    @if(!empty($track['items']))
                        @foreach ($track['items'] as $item)
                            <div class="max-w-xs mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                                <div class="px-4 pb-2 pt-4">
                                    <h3 class="text-xl font-bold text-gray-800 uppercase dark:text-white">{{-- {{ $item['name'] }} --}}{{Str::limit($item['name'], 22, $end='...')}}</h3>
                                    @foreach ($item['artists'] as $artist)   
                                        @if ($loop->first)           
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $artist['name'] }}</p>
                                        @endif
                                    @endforeach 
                                </div>

                                @foreach ($item['album']['images'] as $album)   
                                    @if ($loop->first)
                                        <img class="object-cover w-full mt-2" src="{{ $album['url'] }}" alt="NIKE AIR">
                                    @endif
                                    
                                @endforeach 

                                <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                                    <h1 class="text-lg font-bold text-white"></h1>
                                    @if(!empty($item['preview_url']))
                                    <a class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors duration-200 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none inline-flex items-center" target="_blank" href="{{ $item['preview_url'] }}">
                                        <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                        <span>Preview Song</span>
                                    </a>
                                    @else
                                    <a class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase duration-200 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 leading-5 text-white transition-colors duration-150  border border-transparent rounded-lg opacity-50 cursor-not-allowed focus:outline-none">No preview available</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </body>
</html>
