<?php

use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Feature::Create([
        	'description' 	=> 'logo',
        	'price' 		=> '150'
        ]);
    }
}
