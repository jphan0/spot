@extends('layouts.app')
@section('content')
    <section class="cyan-ease pt-8 md:pt-48">
        <div class="max-w-3xl px-6 pt-4 md:pt-16 mx-auto text-center">
            <a href="/">
                <h1 class="text-5xl md:text-9xl font-light text-offblack dark:text-gray-100 font-itc-garamond">Vacay Tunes</h1>
            </a>
            <p class="max-w-full mx-auto mt-8 text-offblack dark:text-gray-400 text-xl font-optima">Getting ready for a vacation?<br/> Search for songs and playlists available on Spotify and take them offline!</p>
        </div>
        <div class="max-w-3xl px-6 mx-auto text-center">
            <form method="POST" action="/playlist">
                @csrf
                <div class="flex flex-col my-4 space-y-3 sm:space-y-0 sm:flex-row sm:justify-center sm:-mx-2">
                    <input id="playlist" name="playlist" type="text" class="w-full md:w-96 px-6 pt-2 pb-1 text-md text-gray-700 bg-white border border-gray-300 rounded-full sm:mx-2 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none focus:ring font-optima" placeholder="Spotify playlist URL" value="{{ request('playlist') }}" required>
                    
                </div>
                <button class="px-8 pt-3 pb-2 leading-5 transition-colors duration-150 bg-tertiary border border-transparent rounded-full active:bg-tertiary hover:bg-tertiary focus:outline-none focus:shadow-outline-tertiary font-optima uppercase italic font-extrabold text-xl shadow-hard" href="/song">
                    <span class="text-md font-optima">Search</span>
                </button>
                @include('validation')
            </form>
        </div>
    </section>

    @if(!empty($playlist))
    <section class="lg:py-12 lg:flex lg:justify-center">
        <div class="max-w-6xl px-6 mx-auto">
            <div class="container w-100 lg:w-4/5 mx-auto flex flex-col">
                <!-- card -->
                <div v-for="card in cards" class="flex flex-col md:flex-row overflow-hidden bg-white rounded-lg shadow-xl  mt-4 w-100 mx-2">
                    <!-- media -->
                    <div class="h-64 h-auto w-auto md:w-1/2">
                        <img class="inset-0 h-full w-full object-cover object-center" src="{{ $playlist['images'][0]['url']}}" />
                    </div>
                    <!-- content -->
                    <div class="w-full p-8 text-gray-800 flex flex-col justify-between">
                        <h3 class="font-semibold text-2xl leading-tight truncate">{{ $playlist['name']}}</h3>
                        <p class="my-6">
                            {!! $playlist['description']!!}
                        </p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-700 uppercase tracking-wide font-semibold">
                                    {{ $countTracks }} tracks
                                </p>
                            </div>
                            <div class="flex">
                                <a class="hidden px-8 pt-3 pb-2 leading-5 transition-colors duration-150 bg-tertiary border border-transparent rounded-full active:bg-tertiary hover:bg-tertiary focus:outline-none focus:shadow-outline-tertiary font-optima uppercase italic font-extrabold text-sm shadow-hard" href="/playlist/{{ $playlistId }}">
                                    <span class="text-md font-optima">Download Playlist</span>
                                </a>
                                <div class="absolute bottom-0 flex flex-col items-center hidden mb-6 group-hover:flex">
                                    <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">A top aligned tooltip.</span>
                                    <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                </div>
                                {{-- <a class="px-4 py-2 text-sm text-purple-600 font-medium leading-5 text-white transition-colors duration-150 bg-transparent border border-purple-600 rounded-lg active:bg-purple-600 hover:bg-purple-600 hover:text-white focus:outline-none focus:shadow-outline-purple inline-flex items-center" href="/playlistList/{{ $playlistId }}">
                                    <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span>Download Playlist</span>
                                </a> --}}
                            </div>
                        </div>
                    </div>
              </div>
            </div>
            <div class="flex items-center justify-center mt-24 mb-32">
            <!-- Tracks Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-8 pb-5 pt-8 text-md">#</th>
                                <th class="px-8 pb-5 pt-8 text-md">Track</th>
                                <th class="px-8 pb-5 pt-8 text-md">Album</th>
                                <th class="px-8 pb-5 pt-8 text-md">Duration</th>
                                <th class="px-8 pb-5 pt-8 text-md">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach($playlist['tracks']['items'] as $track)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-8 pb-3 pt-5 text-md">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-8 pb-3 pt-5 text-md">
                                    <div class="flex items-center text-sm">
                                        <!-- Avatar with inset shadow -->
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                            <img class="object-cover w-full h-full rounded-full" src="{{ $track['track']['album']['images'][0]['url'] }}" alt="" loading="lazy" />
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $track['track']['name'] }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                @foreach($track['track']['artists'] as $artist)
                                                    {{ $artist['name'] }}
                                                    @if( !$loop->last)
                                                    <span class="-ml-1">,</span>
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 pb-3 pt-5 text-sm">
                                    {{ $track['track']['album']['name'] }}
                                </td>
                                <td class="px-8 pb-3 pt-5 text-sm">
                                    {{ \Carbon\CarbonInterval::milliseconds($track['track']['duration_ms'])->cascade()->forHumans(); }}
                                    {{-- {{ $track['track']['duration_ms'] }}ms --}}
                                </td>
                                <td class="px-8 pb-3 pt-5 text-sm">
                                    <a class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-transparent border border-offblack rounded-lg active:bg-tertiary hover:bg-tertiary hover:border-tertiary hover:text-white focus:outline-none focus:shadow-outline-tertiary inline-flex items-center" href="/song/{{ $track['track']['name'] }} - {{ $track['track']['artists'][0]['name'] }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section> 
    </div>
    @endif 
@endsection

        

