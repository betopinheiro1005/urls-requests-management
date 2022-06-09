<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Url;

class UrlsRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'urls:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'URLs Requests update';

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
        Log::info('Executing Urls Requests...');
        // Url::all();
    }
}
