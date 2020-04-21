<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use App\Type;
use App\Tree;
use Faker\Generator as Faker;

class TreesTableSeeder extends Seeder
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
        $this->seedTrees($faker);
    }

    public function seedTrees($faker)
    {
        $types = Type::all();
        foreach ($types as $type) {
            for ($i = 0; $i < $faker->numberBetween(5, 10); $i++) {
                $trees = $this->checkUnique($type->id, $faker);
            } 
        }
    }

    private function saveUnique($typeId, $name)
    {
        $data = factory(Tree::class, 1)->create(
            [
                'name' => $name,
                'type_id' => $typeId
            ]
        );

        return $data;
    }

    private function checkUnique($typeId, $faker)
    {
        $data = null;
        $name = $faker->word;

        if ($this->savedNames->contains($name)) {
            $this->checkUnique($typeId, $faker); 
        } else {
            $this->savedNames->push($name);
            $data = $this->saveUnique($typeId, $name);
        }

        return $data;
    }
}
