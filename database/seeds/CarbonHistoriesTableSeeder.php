<?php

use Illuminate\Database\Seeder;
use App\AreaTree;
use App\CarbonHistory;

class CarbonHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(AreaTree $areaTree)
    {
        $areaTrees = $areaTree->all(); 

        foreach ($areaTrees as $item) {
            factory(CarbonHistory::class, $item->age)->create(['area_tree_id' => $item->id]);
        }
    }
}
