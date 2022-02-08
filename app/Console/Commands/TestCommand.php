<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cwb:runtest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom Command for exampple description';

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
        $this->info("Custom task started");
        $count = 10;
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        for ($i=0; $i < $count; $i++) {     
            $this->doSomething();
            $bar->advance();
        }
        $bar->finish();
        $this->line('');
        $this->info("Custom task ended");

        return 0;
    }

    public function doSomething(){
        sleep(1);
        return 1;
    }
}
