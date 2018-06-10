<?php

use Illuminate\Database\Seeder;

class ActiveCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ActiveCenter::class,30)->create(); 
    }
}
