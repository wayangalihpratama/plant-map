<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use App\Location;
use Faker\Generator as Faker;

class LocationsTableSeeder extends Seeder
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
        $this->seedParent($faker);
        $this->seedChildrens($faker);
    }

    public function seedParent($faker)
    {
        for ($i = 0; $i < $faker->numberBetween(5, 6); $i++) {
            $parents = $this->checkUnique(null, 1, $faker);
        } 
    }

    public function seedChildrens($faker)
    {
        $parents = Location::where('level', 1)->get();

        foreach ($parents as $parent) {
            for ($i = 0; $i < $faker->numberBetween(7, 8); $i++) {
                $childrens = $this->checkUnique($parent->id, 2, $faker);
            } 
        }
    }

    private function saveUnique($parentId, $level, $name)
    {
        $data = factory(Location::class, 1)->create(
            [
                'name' => $name,
                'parent_id' => $parentId,
                'level' => $level
            ]
        );

        return $data;
    }

    private function checkUnique($parentId, $level, $faker)
    {
        $data = null;
        $name = $faker->city();
        if ($level === 1) {
            $name = $faker->state();
        }

        if ($this->savedNames->contains($name)) {
            $this->checkUnique($parentId, $level, $faker); 
        } else {
            $this->savedNames->push($name);
            $data = $this->saveUnique($parentId, $level, $name);
        }

        return $data;
    }
}
