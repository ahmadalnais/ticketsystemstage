<?php

use Illuminate\Database\Seeder;

class PhasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Phase::Create([
        	'title' => 'DesginFase',
        ]);
    }
}
