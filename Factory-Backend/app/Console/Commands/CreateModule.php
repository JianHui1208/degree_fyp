<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create A New Module in one command.';

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
        $name = $this->argument('name');
        exec('php artisan make:model "' . $name . '" -m');
        exec('php artisan make:controller Admin/"' . $name . '"Controller --resource --requests --model="' . $name . '"');
        exec('php artisan make:controller Api/V1/Admin/"' . $name . '"ApiController --api --requests --model="' . $name . '"');
        exec('php artisan make:controller Api/V1/Users/"' . $name . '"ApiController --api --requests --model="' . $name . '"');
        exec('php artisan make:request ApiRequests/Store"' . $name . '"ApiRequest');
        exec('php artisan make:request ApiRequests/Update"' . $name . '"ApiRequest');
        exec('mkdir resources\views\admin\"' . $name . '"');
        exec('copy .\public\SampleFile\*.* .\resources\views\admin\"' . $name . '"');

        $this->info('The Module Create Successful!');
    }
}
