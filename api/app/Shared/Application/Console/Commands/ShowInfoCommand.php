<?php

namespace App\Shared\Application\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ShowInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:information';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Descripción de tu comando';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $currentDateTime = Carbon::now()->toDateTimeString();

        Log::channel('custom')->info(sprintf('Comando ejecutado en %s', $currentDateTime));

        $this->info(sprintf('Comando ejecutado en %s', $currentDateTime));
    }
}
