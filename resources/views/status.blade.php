@extends('layouts.app')
@section('content')
    <section class="cyan-ease pt-8 md:pt-48">
        <div class="max-w-3xl px-6 pt-4 md:pt-16 mx-auto text-center">
            <a href="/">
                <h1 class="text-5xl md:text-9xl font-light text-offblack dark:text-gray-100 font-itc-garamond">Vacay Tunes</h1>
            </a>
        </div>
        <div class="max-w-3xl px-6 pt-4 md:pt-8 mx-auto font-optima">
            {{-- @livewire('download-song') --}}
            <livewire:download-song :song="$song">
            {{-- <div class="py-4 text-2xl">
                @if ($song->status == 'completed')
                    <h3 class="py-4 text-4xl">Download Status: Complete!</h3>
                    {{ $song->info->title }}<br/><br/>
                    <p>Click <a href="{{ Storage::url('app/public/'. Str::slug($song->info->fulltitle) .'.m4a', '-') }}" class="underline">here</a> to download it</p>
                @endif

                @if($song->status == 'in_progress')
                    <h3 class="py-4 text-4xl">Download Status: In progress...</h3>
                    <p>Please <a href="javascript:;" onclick="window.reload()">refresh</a> this page in a few seconds.</p>
                @endif

                @if ($song->status == 'failed')
                    <h3 class="py-4 text-4xl">Download Status: Failed!</h3>
                    <p>Please try again, if the problem persist, then please contact us.</p>
                @endif
            </div> --}}
        </div>
    </section>
@endsection
