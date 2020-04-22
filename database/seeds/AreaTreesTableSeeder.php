<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use App\Area;
use App\Tree;
use App\AreaTree;
use Faker\Generator as Faker;

class AreaTreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Area $area, Tree $tree, Faker $faker)
    {
        $trees = collect($tree->all()); 
        $areas = $area->all();
        
        foreach ($areas as $plantation) {
            factory(AreaTree::class, $faker->numberBetween(5, 15))->create(
                [
                    'tree_id' => $trees->random(),
                    'area_id' => $plantation->id
                ]
            );
        } 
    }
}
