<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WeeklyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly report to the user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        echo 'Weekly report send to the user';

    }
}
