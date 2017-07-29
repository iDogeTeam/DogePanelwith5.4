<?php

use Illuminate\Database\Seeder;

class IPAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\IPAddress::class,10000)->create();
        //
    }
}
