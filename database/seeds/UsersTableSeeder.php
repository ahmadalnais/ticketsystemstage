<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
        	'name' 		   => 'Ahmad',
        	'email'		   => 'techmen27@gmail.com',
        	'password' 	   => bcrypt('secret'),
        	'phone'		   => '0612345678',
            'company_name' => 'MEN Technology & Media',
            'address'      => 'Boterdiep 65-2',
            'city'         => 'Groningen',
            'zip'          => '9712LK',
            'country'      => 'Nederland',
        ]);
        
        App\User::create([
            'name'         => 'max',
            'email'        => 'max@gmail.com',
            'password'     => bcrypt('secret'),
            'phone'        => '0654345678',
            'company_name' => 'AMAB',
            'address'      => 'Aweg 15 A2',
            'city'         => 'Groningen',
            'zip'          => '9718CV',
            'country'      => 'Nederland',
        ]);
    }
}
