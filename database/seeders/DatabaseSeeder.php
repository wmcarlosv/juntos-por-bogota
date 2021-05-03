<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'aldo',
        	'last_name' => 'pusticcio',
        	'email' => 'apusticcio@gmail.com',
        	'birth_date' => '1988-07-09',
        	'phone' => '3114561548',
        	'address' => 'Cra. 36 #63a-45 Bogotá',
        	'password' => bcrypt('Juntos2021'),
        	'dni' => '19455541',
        	'is_admin' => true
        ]);
    }
}
