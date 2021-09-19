<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class ClearDownloads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleardownloads:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete downloaded songs in the public downloads folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $directory = public_path('downloads/');
        File::deleteDirectory($directory);
        // return 0;
    }
}
