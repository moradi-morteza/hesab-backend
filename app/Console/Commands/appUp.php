<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class appUp extends Command
{
    protected $signature = 'app:install';
    protected $description = 'Restart database and make init data';

    public function handle()
    {
        Artisan::call('key:generate');
        Artisan::call('config:cache');
        File::cleanDirectory(database_path('migrations'));
        Artisan::call('vendor:publish --tag=migrations.modules');
        Artisan::call('migrate:fresh');
        File::cleanDirectory(public_path('files'));
        Artisan::call('passport:install');
        Artisan::call('db:seed');
        Artisan::call('optimize:clear');
        $this->info('Operations Successfully Done.');
    }



}
