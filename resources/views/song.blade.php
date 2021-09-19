@extends('layouts.app')
@section('content')
    <section class="cyan-ease p-8 md:pt-48">
        <div class="max-w-3xl px-6 pt-4 md:pt-16 mx-auto text-center">
            <a href="/">
                <h1 class="text-5xl md:text-9xl font-light text-offblack dark:text-gray-100 font-itc-garamond">Vacay Tunes</h1>
            </a>
            <p class="max-w-full mx-auto mt-8 text-offblack dark:text-gray-400 text-xl font-optima">Getting ready for a vacation?<br/> Search for songs and playlists available on Spotify and take them offline!</p>
        </div>
        <div class="max-w-3xl px-6 mx-auto text-center">
            <form method="POST" action="/song">
                @csrf
                <div class="flex flex-col my-4 space-y-3 sm:space-y-0 sm:flex-row sm:justify-center sm:-mx-2">
                    <input id="song_name" name="song_name" type="text" class="w-full md:w-96 px-6 pt-2 pb-1 text-md text-gray-700 bg-white border border-gray-300 rounded-full sm:mx-2 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none focus:ring font-optima" placeholder="Name of song" value="{{ request('song_name') }}" required>
                    
                </div>
                <button class="px-8 pt-3 pb-2 leading-5 transition-colors duration-150 bg-tertiary border border-transparent rounded-full active:bg-tertiary hover:bg-tertiary focus:outline-none focus:shadow-outline-tertiary font-optima uppercase italic font-extrabold text-xl shadow-hard" href="/song">
                    <span class="text-md font-optima">Search</span>
                </button>
                @include('validation')
            </form>
        </div>
    </section>
    @if(!empty($tracks))
    <section class="py-8 mb-16">
        <div class="max-w-3xl px-6 pt-6 mx-auto text-center">
            <p class="max-w-md mx-auto font-optima text-lg dark:text-gray-400">Showing results for <u>{{ $query }}</u></p><br>
        </div>
        <div class="flex items-center justify-center">
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
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-md font-bold text-gray-800 uppercase dark:text-white ">
                                                {{Str::limit($item['name'], 22, $end='...')}}
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 truncate">
                                            @foreach ($item['artists'] as $artist)   
                                                {{ $artist['name'] }}
                                                @if( !$loop->last)
                                                    <span class="-ml-1">,</span>
                                                @endif
                                            @endforeach 
                                            </p>
                                        </div>
                                        <div>
                                            <a class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-transparent border border-offblack rounded-lg active:bg-tertiary hover:bg-tertiary hover:border-tertiary hover:text-white focus:outline-none focus:shadow-outline-tertiary inline-flex items-center" href="/song/{{ $item['name'] }} - {{ $item['artists'][0]['name'] }}">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @foreach ($item['album']['images'] as $album)   
                                    @if ($loop->first)
                                    <div class="flex-shrink-0 relative">
                                        @if(!empty($item['preview_url']))
                                        <audio x-ref="audio" @click="play = !play">
                                            <source src="{{ $item['preview_url'] }}">
                                        </audio>
                                        <div @click="play = true" x-show="!play" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="absolute inset-0 w-full h-full flex items-center justify-center">
                                            <svg class="h-20 w-20 text-tertiary" fill="currentColor" viewBox="0 0 84 84">
                                                <circle opacity="0.8" cx="42" cy="42" r="42" fill="white"></circle>
                                                <path d="M55.5039 40.3359L37.1094 28.0729C35.7803 27.1869 34 28.1396 34 29.737V54.263C34 55.8604 35.7803 56.8131 37.1094 55.9271L55.5038 43.6641C56.6913 42.8725 56.6913 41.1275 55.5039 40.3359Z"></path>
                                            </svg>
                                        </div>
                                        <div @click="play = !true" x-show="play" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="absolute inset-0 w-full h-full flex items-center justify-center">
                                            <svg class="h-20 w-20 text-tertiary" fill="currentColor" viewBox="0 0 84 84">
                                                <circle opacity="0.8" cx="42" cy="42" r="42" fill="white"></circle>
                                                <path d="M 37 32 C 37 25 28 25 28 32 V 52 C 28 58 37 58 37 52 Z M 54 32 C 54 25 45 25 45 32 V 52 C 45 58 54 58 54 52 Z"></path>
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
    </section>
    @endif 
@endsection
