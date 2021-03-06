<?php

namespace App\Jobs;

use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;
use Throwable;

class DownloadSong implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Song
     */
    private $song;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $process = new Process([
            'youtube-dl',
            '-f140',
            '--restrict-filenames',
            $this->song->url,
            '-o',
            // storage_path('app/public/downloads/%(title)s.%(ext)s')
            public_path('downloads/'. str_replace(' ', '_', $this->song->filename) .'.%(ext)s')
            , '--print-json'
        ]);

        try {
            $process->mustRun();
            $output = json_decode($process->getOutput(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->song->status = 'failed';
            } else {
                $this->song->status = 'completed';
                $this->song->info = $output;
                $this->song->save();
            }
        } catch (Throwable $exception) {
            $this->song->status = 'failed';
            $this->song->save();
            logger(sprintf('Could not download song id %d with url %s', $this->song->id, $this->song->url));
            throw new $exception;
        }
    }
}
