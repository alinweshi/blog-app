<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class InstallProjectCommand extends Command
{
    protected $signature = 'install:project {name}';
    protected $description = 'Install and configure the Laravel project (migrate, seed, auth setup, admin user)';

    public function handle()
    {
        $projectName = $this->argument('name');
        $this->info("Installing project: {$projectName}");

        // Step 1: Fresh migration
        $this->call('migrate:fresh');

        // Step 2: Seed database
        $this->call('db:seed');

        // Step 3: Install authentication system
        \Tymon\JWTAuth\Providers\LaravelServiceProvider::class;
        $this->call('jwt:secret');


        // Step 4: Publish Telescope config
        if (class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->info('📡 Publishing Telescope config...');
            $this->call('vendor:publish', [
                '--provider' => 'Laravel\Telescope\TelescopeServiceProvider'
            ]);
        }
        // Step 6: Create a default admin 
        if (!Admin::where('email', 'alinweshi@gmail.com')->exists()) {
            $this->info('👑 Creating default admin user...');
            Admin::create([
                'first_name' => 'ali',
                'last_name' => 'nweshi',
                'email' => 'alinweshi@gmail.com',
                'mobile' => '01091092848',
                'password' => Hash::make('password'),
            ]);
        }



        // Step 6: Create a default admin user
        $this->info('👑 Creating default admin user...');
        if (!User::where('email', 'alinweshi@gmail.com')->exists()) {
            User::create([
                'first_name' => 'ali',
                'last_name' => 'nweshi',
                'email' => 'alinweshi@gmail.com',
                'mobile' => '01091092848',
                'password' => Hash::make('password'),
            ]);
        }

        // Step 7: Clear caches
        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');

        $this->info('✅ Project installed successfully!');
        $this->info('🔐 Default Admin Login:');
        $this->info('   Email: alinweshi@gmail.com');
        $this->info('   Password: password');
    }
}
