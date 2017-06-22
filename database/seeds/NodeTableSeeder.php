<?php

use Illuminate\Database\Seeder;

class NodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    factory(App\NodeGroup::class, 10)->create()->each(function ($u){
		    $u->nodes()->saveMany(factory(App\Node::class,10)->make());
	    });
    }
}
