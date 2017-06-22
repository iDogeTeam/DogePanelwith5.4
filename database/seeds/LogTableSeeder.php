<?php

use Illuminate\Database\Seeder;

class LogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		factory(App\TrafficLog::class,100)->create();
		factory(App\ItemLog::class,100)->create();
    }
}
