<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
         $this->call(ServiceTableSeeder::class);
    }

    public function test()
    {
        $this->call(TestSeeder::class);
    }
}
