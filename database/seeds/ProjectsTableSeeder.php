<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Project::Create([
        	'name' 	 => 'Ahmad',
        	'choose' => 'website',
            'user_id' => '1',
        ]);
    }
}
