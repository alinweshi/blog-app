<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        User::create([
            'first_name' => 'ali',
            'last_name' => 'nweshi',
            'username' => 'ali.nweshi',
            'phone' => '01091092848',
            'email' => 'ali.nweshi@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        User::factory()->count(10)->create();
    }
}
