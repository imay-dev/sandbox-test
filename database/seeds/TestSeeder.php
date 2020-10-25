<?php

use App\Entities\Invoice;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Entities\User::class, 10)->create();
        for ($i = 0; $i < 2500; $i++) {
            factory(Invoice::class, 400)
                ->create();
        }
    }
}
