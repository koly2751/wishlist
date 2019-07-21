<?php

use Illuminate\Database\Seeder;

class WrappTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        factory(\App\Wrapp::class,20)->create();
    }
}
