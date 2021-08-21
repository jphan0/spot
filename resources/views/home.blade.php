<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="//unpkg.com/alpinejs" defer></script>
        <title>Spot</title>
    </head>
    <body class="antialiased">  
        <section class="mt-24">
            <div class="max-w-3xl px-6 pt-16 mx-auto text-center">
                <div class="flex flex-wrap justify-center">
                    <div class="w-6/12 sm:w-4/12 px-4 mb-8">
                        <img src="/img/spot.png" alt="spot logo" class="max-w-full h-auto align-middle border-none" />
                    </div>
                </div>
                <h1 class="text-8xl font-semibold text-gray-800 dark:text-gray-100 font-gastromond">Spot Search</h1>
                <p class="max-w-md mx-auto mt-8 text-gray-500 dark:text-gray-400">Type in the name of the song you would like to search</p>
                <form method="POST" action="/">
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
                            <div class="max-w-xs mx-auto overflow-hidden bg-white rounded-lg shadow-2xl dark:bg-gray-800" x-data="{ play: false }" x-init="$watch('play', (value) => {
                                if (value) {
                                    $refs.audio.play()
                                } else {
                                    $refs.audio.pause()
                                }
                            })">
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
                                    <div class="flex-shrink-0 relative">
                                        @if(!empty($item['preview_url']))
                                        <audio x-ref="audio" @click="play = !play">
                                            <source src="{{ $item['preview_url'] }}">
                                        </audio>
                                        <div @click="play = true" x-show="!play" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="absolute inset-0 w-full h-full flex items-center justify-center">
                                            <svg class="h-20 w-20 text-purple-600" fill="currentColor" viewBox="0 0 84 84">
                                                <circle opacity="0.8" cx="42" cy="42" r="42" fill="white"></circle>
                                                <path d="M55.5039 40.3359L37.1094 28.0729C35.7803 27.1869 34 28.1396 34 29.737V54.263C34 55.8604 35.7803 56.8131 37.1094 55.9271L55.5038 43.6641C56.6913 42.8725 56.6913 41.1275 55.5039 40.3359Z"></path>
                                            </svg>
                                        </div>
                                        <div @click="play = !true" x-show="play" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="absolute inset-0 w-full h-full flex items-center justify-center">
                                            <svg class="h-20 w-20 text-purple-600" fill="currentColor" viewBox="0 0 84 84">
                                                <circle opacity="0.8" cx="42" cy="42" r="42" fill="white"></circle>
                                                <path d="M 38 28 C 38 22 29 22 29 28 V 53 C 29 59 38 59 38 53 Z M 55 28 C 55 22 46 22 46 28 V 53 C 46 59 55 59 55 53 Z"></path>
                                            </svg>
                                        </div>
                                        @endif
                                        <img class="object-cover w-full mt-2" src="{{ $album['url'] }}" alt="{{ $item['album']['name'] }}">
                                    </div>
                                    @endif 
                                @endforeach 
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
        @endif 
    </body>
</html>
