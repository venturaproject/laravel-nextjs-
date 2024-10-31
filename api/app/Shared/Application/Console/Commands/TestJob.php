<?php
  
  namespace App\Shared\Application\Console\Commands;
  
use Illuminate\Console\Command;
  
class TestJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-job';
  
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
  
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        info('Command runs every TEST.');
    }
}