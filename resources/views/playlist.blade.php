<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Search songs available through spotify" />
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🔥</text></svg>">
        <link rel="alternate icon" href="/favicon.ico">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="//unpkg.com/alpinejs" defer></script>
        <title>Spot Search</title>
    </head>
    <body class="antialiased">  
        <section class="mt-8 md:mt-32">
            <div class="max-w-3xl px-6 pt-4 md:pt-16 mx-auto text-center">
                <div class="flex flex-wrap justify-center">
                    <div class="w-4/12 px-4 mb-8">
                        {{-- <img src="/img/spot.png" alt="spot logo" class="max-w-full h-auto align-middle border-none" /> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke-width="2" class="ai ai-SpotifyFill w-20 h-20 md:w-32 md:h-32 mx-auto text-gray-800 dark:text-gray-100"><path d="M11.995 0C5.381 0 0 5.382 0 11.996 0 18.616 5.381 24 11.995 24 18.615 24 24 18.615 24 11.996 24 5.382 18.615 0 11.995 0zM5.908 16.404a14.548 14.548 0 0 1 4.238-.638c2.414 0 4.797.612 6.892 1.77.125.068.238.292.29.572.05.28.03.567-.052.716a.61.61 0 0 1-.834.24A13.107 13.107 0 0 0 6.277 18.03a.61.61 0 0 1-.771-.402c-.107-.35.114-1.13.402-1.224zm-.523-4.42a18.154 18.154 0 0 1 4.76-.635c2.894 0 5.767.7 8.31 2.026.179.09.31.244.37.432a.747.747 0 0 1-.052.578c-.227.444-.493.743-.66.743a.769.769 0 0 1-.35-.086 16.33 16.33 0 0 0-7.617-1.854 16.34 16.34 0 0 0-4.366.585.749.749 0 0 1-.92-.525c-.112-.422.145-1.16.525-1.264zM5.25 9.098a.88.88 0 0 1-1.073-.641c-.123-.498.188-1.076.64-1.19a22.365 22.365 0 0 1 5.328-.649c3.45 0 6.756.776 9.824 2.307a.888.888 0 0 1 .4 1.19c-.143.288-.453.598-.795.598a.924.924 0 0 1-.388-.087 20.026 20.026 0 0 0-9.041-2.126c-1.635 0-3.282.201-4.895.598z"/></svg>
                    </div>
                </div>
                <h1 class="text-5xl md:text-8xl font-semibold text-gray-800 dark:text-gray-100 font-gastromond">Spot Search</h1>
                <p class="max-w-md mx-auto mt-8 text-gray-500 dark:text-gray-400">Search for your Spotify playlist!</p>
                <form method="POST" action="/playlist">
                    @csrf
                    <div class="flex flex-col my-8 space-y-3 sm:space-y-0 sm:flex-row sm:justify-center sm:-mx-2">
                        <input id="playlist" name="playlist" type="text" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md sm:mx-2 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-purple-500 dark:focus:border-purple-500 focus:outline-none focus:ring" placeholder="Playlist URL" value="{{ request('playlist') }}" required>
                        <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple inline-flex items-center disabled" >
                            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            <span>Search</span>
                        </button>
                    </div>
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
                            <p class="mt-2">
                                {!! $playlist['description']!!}
                            </p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-700 uppercase tracking-wide font-semibold mt-2">
                                        {{ $countTracks }} tracks
                                    </p>
                                </div>
                                <div>
                                    <a class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple inline-flex items-center disabled" href="#">
                                        <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                                        <span>Get YT Links</span>
                                    </a>
                                    <a class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple inline-flex items-center disabled" href="#">
                                        <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span>Download Playlist</span>
                                    </a>
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
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Track</th>
                                    <th class="px-4 py-3">Album</th>
                                    <th class="px-4 py-3">Duration</th>
                                    {{-- <th class="px-4 py-3">Date Released</th> --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @foreach($playlist['tracks']['items'] as $track)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-3">
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
                                                        ,
                                                        @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        {{ $track['track']['album']['name'] }}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        {{-- <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Approved
                                        </span> --}}
                                        {{ $track['track']['duration_ms'] }}
                                    </td>
                                    {{-- <td class="px-4 py-3 text-sm">
                                        {{ $track['track']['album']['release_date'] }}
                                    </td> --}}
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
