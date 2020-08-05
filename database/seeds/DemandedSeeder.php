<?php

use Illuminate\Database\Seeder;

class DemandedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Demanded::class, 10)->create();
    }
}
