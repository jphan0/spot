<nav class="cyan dark:bg-gray-800 font-itc-garamond text-2xl">
    <div class="container flex items-center justify-center p-6 mx-auto text-gray-600 capitalize dark:text-gray-300">
        <a href="{{ route('home') }}" class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-tertiary mx-1.5 sm:mx-6 {!! request()->routeIs('home') ? 'border-b-2 border-tertiary' : '' !!}">home</a>

        <a href="{{ route('songs') }}" class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-tertiary mx-1.5 sm:mx-6 {!! request()->is('song') ? 'border-b-2 border-tertiary' : '' !!}">songs</a>

        <a href="{{ route('playlists') }}" class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-tertiary mx-1.5 sm:mx-6 {!! request()->is('playlist') ? 'border-b-2 border-tertiary' : '' !!}">playlists</a>

        <a href="{{ route('about') }}" class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-tertiary mx-1.5 sm:mx-6 {!! request()->routeIs('about') ? 'border-b-2 border-tertiary' : '' !!}">About</a>
    </div>
</nav>