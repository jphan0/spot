<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Spot</title>
    </head>
    <body class="antialiased">  
        <section class="mt-64">
            <div class="max-w-3xl px-6 pt-16 mx-auto text-center">
                <h1 class="text-8xl font-semibold text-gray-800 dark:text-gray-100 font-gastromond">Spot Search</h1>
                <p class="max-w-md mx-auto mt-8 text-gray-500 dark:text-gray-400">Type in the name of the song you would like to search</p>
                <form method="POST" action="/search">
                    @csrf
                    <div class="flex flex-col my-8 space-y-3 sm:space-y-0 sm:flex-row sm:justify-center sm:-mx-2">
                        <input id="song_name" name="song_name" type="text" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md sm:mx-2 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" placeholder="Name of song" required>

                        <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple inline-flex items-center disabled" >
                            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            <span>Search</span>
                        </button>
                    </div>
                    @include('validation')
                </form>
            </div>
        </section>
        @if(!empty($tracks))
        <div class="max-w-3xl px-6 pt-6 mx-auto text-center">
            <p class="max-w-md mx-auto text-gray-500 dark:text-gray-400">Showing results for "<u>{{ $query }}</u>"</p>
        </div>
        <div class="flex items-center justify-center mt-8 mb-32">
            <div class="grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($tracks as $track) 
                    @if(!empty($track['items']))
                        @foreach ($track['items'] as $item)
                            <div class="max-w-xs mx-auto overflow-hidden bg-white rounded-lg shadow-2xl dark:bg-gray-800">
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
        @endif 
    </body>
</html>
