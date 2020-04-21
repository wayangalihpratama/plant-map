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
        //$this->call(UserSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(TreesTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(AreaTreesTableSeeder::class);
        $this->call(CarbonHistoriesTableSeeder::class);
    }
}
