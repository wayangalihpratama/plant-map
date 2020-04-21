<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use App\Type;
use Faker\Generator as Faker;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function __construct()
    {
        $this->savedNames = collect();
    }
    
    public function run(Faker $faker)
    {
        $this->seedTypes($faker);
    }

    public function seedTypes($faker)
    {
        for ($i = 0; $i < $faker->numberBetween(10, 25); $i++) {
            $types = $this->checkUnique($faker);
        } 
    }

    private function saveUnique($name)
    {
        $data = factory(Type::class, 1)->create(['name' => $name]);

        return $data;
    }

    private function checkUnique($faker)
    {
        $data = null;
        $name = $faker->stateAbbr;

        if ($this->savedNames->contains($name)) {
            $this->checkUnique($faker); 
        } else {
            $this->savedNames->push($name);
            $data = $this->saveUnique($name);
        }

        return $data;
    }
}
