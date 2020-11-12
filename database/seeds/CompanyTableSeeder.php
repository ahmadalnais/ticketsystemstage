<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Company::Create([
        	'name' 		=> 'MEN Technology & Media',
        	'phone' 	=> '+316 45 53 21 65',
        	'email' 	=> 'informatie@mentechmedia.nl',
        	'btw' 		=> 'NL863329182B01',
        	'iban' 		=> 'NL63 INGB 0006 64 18 34',
        	'kvk' 		=> '60504595',
        	'address' 	=> 'Boterdiep 65-2',
        	'city' 		=> 'Groningen',
        	'zip' 	=> '9712LK',
        	'country' 	=> 'Nederland',
        ]);
    }
}
