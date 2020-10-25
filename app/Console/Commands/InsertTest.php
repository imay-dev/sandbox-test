<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InsertTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserts a million records in invoices table';

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
        echo 'Inserting...';
        (new \DatabaseSeeder())->test();
        return 'Done !';
    }
}
