<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(PhasesTableSeeder::class);
        $this->call(FeaturesTableSeeder::class);
    }
}
