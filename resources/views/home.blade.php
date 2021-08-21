<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="//unpkg.com/alpinejs" defer></script>
        <title>Spot Search</title>
    </head>
    <body class="antialiased">  
        <section class="mt-24">
            <div class="max-w-3xl px-6 pt-16 mx-auto text-center">
                <div class="flex flex-wrap justify-center">
                    <div class="w-6/12 sm:w-4/12 px-4 mb-8">
                        <img src="/img/spot.png" alt="spot logo" class="max-w-full h-auto align-middle border-none" />
                    </div>
                </div>
                <h1 class="text-8xl sm:text-xl font-semibold text-gray-800 dark:text-gray-100 font-gastromond">Spot Search</h1>
                <p class="max-w-md mx-auto mt-8 text-gray-500 dark:text-gray-400">Search for songs available through Spotify!</p>
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
            <p class="max-w-md mx-auto text-gray-500 dark:text-gray-400">Showing results for "<u>{{ $query }}</u>"</p><br>
            {{-- <a class="px-4 py-2 text-sm font-medium leading-5 text-gray-400 transition-colors duration-150 bg-gray-200 border border-transparent rounded-lg active:bg-gray-200 hover:bg-gray-300 focus:outline-none focus:shadow-outline-gray inline-flex items-center disabled" href="{{ route('home') }}">
                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Clear</span>
            </a> --}}
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
    <footer>
        <div class="container px-6 py-8 mx-auto">

            <hr class="my-10 dark:border-gray-500">

            <div class="sm:flex sm:items-center sm:justify-between">
                <p class="text-sm text-gray-500 dark:text-gray-400">Made by James Phan &copy; 2021 </p>

                <div class="flex mt-3 -mx-2 sm:mt-0">
                    <a href="https://github.com/jphan0" class="mx-2 text-gray-500 hover:text-gray-600 dark:hover:text-gray-300" aria-label="Github">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.026 2C7.13295 1.99937 2.96183 5.54799 2.17842 10.3779C1.395 15.2079 4.23061 19.893 8.87302 21.439C9.37302 21.529 9.55202 21.222 9.55202 20.958C9.55202 20.721 9.54402 20.093 9.54102 19.258C6.76602 19.858 6.18002 17.92 6.18002 17.92C5.99733 17.317 5.60459 16.7993 5.07302 16.461C4.17302 15.842 5.14202 15.856 5.14202 15.856C5.78269 15.9438 6.34657 16.3235 6.66902 16.884C6.94195 17.3803 7.40177 17.747 7.94632 17.9026C8.49087 18.0583 9.07503 17.99 9.56902 17.713C9.61544 17.207 9.84055 16.7341 10.204 16.379C7.99002 16.128 5.66202 15.272 5.66202 11.449C5.64973 10.4602 6.01691 9.5043 6.68802 8.778C6.38437 7.91731 6.42013 6.97325 6.78802 6.138C6.78802 6.138 7.62502 5.869 9.53002 7.159C11.1639 6.71101 12.8882 6.71101 14.522 7.159C16.428 5.868 17.264 6.138 17.264 6.138C17.6336 6.97286 17.6694 7.91757 17.364 8.778C18.0376 9.50423 18.4045 10.4626 18.388 11.453C18.388 15.286 16.058 16.128 13.836 16.375C14.3153 16.8651 14.5612 17.5373 14.511 18.221C14.511 19.555 14.499 20.631 14.499 20.958C14.499 21.225 14.677 21.535 15.186 21.437C19.8265 19.8884 22.6591 15.203 21.874 10.3743C21.089 5.54565 16.9181 1.99888 12.026 2Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</html>
