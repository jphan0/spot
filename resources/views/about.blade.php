@extends('layouts.app')
@section('content')
    <section class="pt-16 md:pt-48">
        <div class="max-w-3xl px-6 pt-4 md:pt-16 mx-auto text-center">
            <a href="/">
                <h1 class="text-5xl md:text-9xl font-light text-offblack dark:text-gray-100 font-itc-garamond">About</h1>
            </a>
            {{-- <p class="max-w-full mx-auto mt-8 text-offblack dark:text-gray-400 text-xl font-optima">Getting ready for a vacation?<br/> Search for songs and playlists available on Spotify and take them offline!</p> --}}
        </div>
        <div class="max-w-3xl px-6 pt-4 md:pt-8 mx-auto font-itc-garamond" x-data="{ show: false }">
            <h3 class="py-4 text-4xl">How does it work?</h3>
            <p class="py-4 text-2xl">
                This site searches Spotify for your songs and playlists and finds the closest matching YouTube video(s). The audio is then extracted from the video(s) and converted to an M4A file for you to take on the road!
            </p>
            <h3 class="py-4 text-4xl">Why M4A?</h3>
            <p class="py-4 text-2xl">
                128kbps AAC in M4A container good, MP3 bad.
                <br/><br/>
                <a @click="show = !show" class="underline cursor-pointer">Okay, but I'd like a little bit more <span class="italic">detail...</span></a>
            </p>
            <div id="m4a-explanation" x-show="show">
                <p class="py-4 text-2xl">
                    Alrighty then...
                </p>
                <p class="py-4 text-2xl">
                Back in the early 90's pretty much everyone's bandwidth and disk space was much much smaller than we're used to now. 16bit 44.1kHz PCM lossless audio (like on a CD) was prohibitively large to be shared, so there was demand for "lossy" codecs to make audio smaller -- their primary purpose being "to save space / bandwidth". Many tried, but MP3 was much better than it's predecessors (e.g. "realAudio"). MP3 was really ground breaking at the time, but not without it's flaws, some of which were addressed in updates, but there are some issues that simply can not be fixed and remain compatible -- the spec does not allow it, so even today with the latest and best MP3 encoders, there are "problem" or "killer" samples / sounds that are impossible to encode without artifacts.
                </p>
                <p class="py-4 text-2xl">
                    AAC was designed to replace MP3 -- it's more efficient, sounds better at lower bitrates, and it has fewer problem samples and less artifacts. Back in the 90's when it was launched it's popularity was hampered by licensing fees, and the lack of a good quality free encoder, this was just around the time when MP3 got hugely popular as "teh scene" took off.
                </p>
                <p class="py-4 text-2xl">
                    AAC is also the broadcast industry standard (ITU & EBU) for distribution of audio for consumers, hence it's use by the major streaming platforms (Netflix, Prime, Hulu, HBO, BBC iPlayer, ITV, and I'm sure most if not all other broadcasters' online offerings etc.) It's the default recording format for pretty much all consumer & pro-sumer kit, so it makes sense that Youtube's upload guidelines recommend it.
                </p>
                <p class="py-4 text-2xl">
                    Due to the way these lossy (aka "perceptual") codecs work, some data is discarded with each encode. The algorithms used by each codec (known as it's "acoustic model") are very complex and, among other things, take advantage of a phenomena known as "masking" where any particular frequency may be inaudible in the presence of other (perhaps) louder frequencies - as you can imagine this happens "almost all the time" in a lot of music, and less often in other styles/genres. One of the ways lossy codecs work, is by not wasting bits on encoding sounds that humans are unlikely to hear (we don't hear all frequencies equally (see Fletcher Munson curves etc)). As technology has progressed the algorithms and codecs have got better, but alas they're not usually backwards compatible, so we end up with newer codecs generally doing a better job.
                </p>
                <p class="py-4 text-2xl">
                    However, due to this model of discarding data, there is a major caveat:- Ideally only lossless material should be ever be encoded with a lossy codec. Re-encoding lossy material to either the same or other lossy codecs always reduces the quality every time. (Fortunately, things are so good now that it's often very hard to hear the degradation for the first few times with most material, but due to their nature, some sounds are much more noticeable, and different codecs may be more suited to one or another type of music.) In general AAC is much more resilient to generational loss than MP3 and most others.
                </p>
                <p class="py-4 text-2xl">
                    Youtube only offers AAC or Opus audio - both lossy formats, so converting these to MP3 can only ever sound worse, no matter what the bitrate. Adding more bitrate only wastes space in this case, (and the primary purpose of lossy codecs is to save space), also the encode can't possibly be better than it's source -- just like making a WAV or FLAC of an MP3 does not restore the quality, or nor does making an 1920X1080 lossless PNG of a 640x480 JPG undo the jpeg compression.
                </p>
                <p class="py-4 text-sm">
                    <a href="https://old.reddit.com/r/youtubedl/comments/jlm7ot/mp3_or_m4a/gapwuxf/" class="underline italic">Source</a>
                </p>
            </div>
        </div>
    </section>
@endsection
