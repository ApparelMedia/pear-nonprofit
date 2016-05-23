<?php

use Illuminate\Database\Seeder;

class NonprofitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Nonprofit::class, 100)->create();
    }
}
