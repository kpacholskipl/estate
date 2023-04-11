<?php

namespace App\Console\Commands;

use App\Jobs\ChangeSupervisor;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\PendingDispatch;

class RunChangeSupervisorJob extends Command
{
    protected $signature = 'change-supervisor';

    protected $description = 'Command description';

    public function handle()
    {
        ChangeSupervisor::dispatch();
    }
}
