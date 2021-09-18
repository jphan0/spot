<div wire:poll class="text-center mt-8 mb-32">
        @if ($song->status == 'in_progress')
        <p class="max-w-full mx-auto mt-8 text-offblack dark:text-gray-400 text-xl font-optima">Getting your song ready to take offline</p>
        <p class="max-w-full mx-auto mt-8">
            <button type="button" class="inline-flex items-center px-8 pt-3 pb-2 leading-5 transition-colors duration-150 bg-transparent border-5 border-tertiary rounded-full active:bg-tertiary hover:bg-tertiary focus:outline-none focus:shadow-outline-tertiary font-optima uppercase italic font-extrabold text-xl shadow-hard cursor-not-allowed" disabled="">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing
            </button>
        </p>
        @elseif ($song->status == 'completed')
        <p class="max-w-full mx-auto mt-8 text-offblack dark:text-gray-400 text-xl font-optima">{{ $song->info->title }} <br/>is ready for download</p>
        <p class="max-w-full mx-auto mt-8">
            <a class="px-8 pt-3 pb-2 leading-5 transition-colors duration-150 bg-transparent border-5 border-tertiary rounded-full active:bg-tertiary hover:bg-tertiary focus:outline-none focus:shadow-outline-tertiary font-optima uppercase italic font-extrabold text-xl shadow-hard" href="{{ route('download', ['song' => $song]) }}">
                Download
            </a>
        </p>
        @elseif ($song->status == 'failed')
        <p>Please try again, if the problem persist, then please contact us.</p>
        @endif

        {{-- href="{{ url('/download/'.str_replace(' ', '_', $song->info->fulltitle).'.m4a') }}" --}}

    {{-- <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-8 pb-5 pt-8 text-md">Status</th>
                        <th class="px-8 pb-5 pt-8 text-md">Message</th>
                        <th class="px-8 pb-5 pt-8 text-md">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">
                        @if ($song->status == 'in_progress')
                            <td class="px-8 pb-3 pt-5 text-md">
                                <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:text-white dark:bg-yellow-600">
                                    Downloading
                                </span>
                            </td>
                            <td class="px-8 pb-3 pt-5 text-md">Getting your song</td>
                            <td class="px-8 pb-3 pt-5 text-md"></td>
                        @elseif($song->status == 'completed')
                            <td class="px-8 pb-3 pt-5 text-md">
                                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    Completed
                                </span>
                            </td>
                            <td class="px-8 pb-3 pt-5 text-md">{{ $song->info->title }} ready for download</td>
                            <td class="px-8 pb-3 pt-5 text-md">
                                <a href="{{ Storage::url('app/public/'. Str::slug($song->info->fulltitle, '_') .'.m4a') }}" class="underline">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </td>
                        @elseif ($song->status == 'failed')
                            <td class="px-8 pb-3 pt-5 text-md">
                                <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                    Failed
                                </span>
                            </td>
                            <td class="px-8 pb-3 pt-5 text-md">Please try again, if the problem persist, then please contact us.</td>
                            <td class="px-8 pb-3 pt-5 text-md"></td>
                        @else
                            <td class="px-8 pb-3 pt-5 text-md">
                                <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:text-white dark:bg-yellow-600">
                                    Error
                                </span>
                            </td>
                            <td class="px-8 pb-3 pt-5 text-md">An unexpected error has occured. Please try again, if the problem persist, then please contact us.</td>
                            <td class="px-8 pb-3 pt-5 text-md"></td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}
</div>