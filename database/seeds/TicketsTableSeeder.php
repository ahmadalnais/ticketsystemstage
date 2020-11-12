<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ticket::Create([
        	'title' => 'test',
        	'description' => 'test',
        	'url' => 'test',
        	'device' => 'PC',
            'type' => 'Samsung',
            'device_name' => 'galaxy s10',
        	'project_id' => '1',
        	'browser' => 'GoogleChrome',
            'version_number' => '77.0.3865.90',
        ]);
    }
}
