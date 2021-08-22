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
        <section class="mt-8 md:mt-32">
            <div class="max-w-3xl px-6 pt-4 md:pt-16 mx-auto text-center">
                <div class="flex flex-wrap justify-center">
                    <div class="w-4/12 px-4 mb-8">
                        <img src="/img/spot.png" alt="spot logo" class="max-w-full h-auto align-middle border-none" />
                    </div>
                </div>
                <h1 class="text-5xl md:text-8xl font-semibold text-gray-800 dark:text-gray-100 font-gastromond">Spot Search</h1>
                <p class="max-w-md mx-auto mt-8 text-gray-500 dark:text-gray-400">Search for songs available through Spotify!</p>
                <form method="POST" action="/">
                    @csrf
                    <div class="flex flex-col my-8 space-y-3 sm:space-y-0 sm:flex-row sm:justify-center sm:-mx-2">
                        <input id="song_name" name="song_name" type="text" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md sm:mx-2 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none focus:ring" placeholder="Name of song" required>
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
        </div>
        <div class="flex items-center justify-center mb-32">
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
        <footer>
            <div class="container px-6 py-8 mx-auto">
                <hr class="my-10 dark:border-gray-500">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Made by <a href="https://jphan.info">James Phan</a> &copy; 2021 </p>

                    <div class="flex mt-3 -mx-2 sm:mt-0">
                        <a href="https://jphan.info/" class="mx-2 text-gray-500 hover:text-gray-600 dark:hover:text-gray-300" aria-label="Github">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ai ai-Globe w-5 h-5"><circle cx="12" cy="12" r="10"/><ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(90 12 12)"/><path d="M2 12h20"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/in/jphan0/" class="mx-2 text-gray-500 hover:text-gray-600 dark:hover:text-gray-300" aria-label="Github">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke-width="2" class="ai ai-LinkedInV1Fill w-5 h-5"><path fill-rule="evenodd" clip-rule="evenodd" d="M1 2.838A1.838 1.838 0 0 1 2.838 1H21.16A1.837 1.837 0 0 1 23 2.838V21.16A1.838 1.838 0 0 1 21.161 23H2.838A1.838 1.838 0 0 1 1 21.161V2.838zm8.708 6.55h2.979v1.496c.43-.86 1.53-1.634 3.183-1.634 3.169 0 3.92 1.713 3.92 4.856v5.822h-3.207v-5.106c0-1.79-.43-2.8-1.522-2.8-1.515 0-2.145 1.089-2.145 2.8v5.106H9.708V9.388zm-5.5 10.403h3.208V9.25H4.208v10.54zM7.875 5.812a2.063 2.063 0 1 1-4.125 0 2.063 2.063 0 0 1 4.125 0z"/></svg>
                        </a>
                        <a href="https://github.com/jphan0/spot" class="mx-2 text-gray-500 hover:text-gray-600 dark:hover:text-gray-300" aria-label="Github">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke-width="2" class="ai ai-GithubFill w-5 h-5"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
