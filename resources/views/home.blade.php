@extends('layouts.app')
@section('content')
    <section class="cyan-ease pt-8 md:pt-48">
        <div class="max-w-3xl px-6 pt-4 md:pt-16 mx-auto text-center">
            <a href="/">
                <h1 class="text-5xl md:text-9xl font-light text-offblack dark:text-gray-100 font-itc-garamond">Vacay Tunes</h1>
            </a>
            <p class="max-w-full mx-auto mt-8 text-offblack dark:text-gray-400 text-xl font-optima">Getting ready for a vacation?<br/> Search for songs and playlists available on Spotify and take them offline!</p>
        </div>
        <div class="max-w-3xl px-6 pt-4 md:pt-8 mx-auto text-center">
            <a type="button" class="w-full md:w-80 max-w-3xl mt-4 px-8 pt-3 pb-2 leading-5 transition-colors duration-150 bg-tertiary border border-transparent rounded-full active:bg-tertiary hover:bg-tertiary focus:outline-none focus:shadow-outline-tertiary font-optima uppercase italic font-extrabold text-xl shadow-hard" href="/song">
                Download Songs
            </a>
            <a type="button" class="w-full md:w-80 md:max-w-3xl md:ml-4 mt-4 px-8 pt-3 pb-2 leading-5 transition-colors duration-150 bg-tertiary border border-transparent rounded-full active:bg-tertiary hover:bg-tertiary focus:outline-none focus:shadow-outline-tertiary font-optima uppercase italic font-extrabold text-xl shadow-hard" href="/playlist">
                Download Playlists
            </a>
        </div>
    </section>
@endsection
