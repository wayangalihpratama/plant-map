<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use App\Area;
use App\Location;
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function __construct()
    {
        $this->savedNames = collect();
        $this->savedLat = collect();
        $this->savedLng = collect();
    }
    
    public function run(Faker $faker)
    {
        $this->seedAreas($faker);
    }

    public function seedAreas($faker)
    {
        $locations = Location::whereNotNull('parent_id')->get();
        foreach ($locations as $location) {
            for ($i = 0; $i < $faker->numberBetween(50, 100); $i++) {
                $name = $this->checkUnique($faker, 'name', $this->savedNames);
                $lat = $this->checkUnique($faker, 'lat', $this->savedLat);
                $lng = $this->checkUnique($faker, 'lng', $this->savedLng);
                $data = $this->saveUnique($location->id, $name, $lat, $lng);
            } 
        }
    }

    private function saveUnique($locationId, $name, $lat, $lng)
    {
        $data = factory(Area::class, 1)->create(
            [
                'name' => $name,
                'geometry' => new Point($lat, $lng),
                'location_id' => $locationId
            ]
        );

        return $data;
    }

    private function checkUnique($faker, $flag, $collection)
    {
        $data = $faker->streetName . ' ' . $faker->buildingNumber();
        if ($flag === 'lat') {
            $data = $faker->latitude($min = -90, $max = 90);
        }

        if ($flag === 'lng') {
            $data = $faker->longitude($min = -180, $max = 180);
        }

        if ($collection->contains($data)) {
            $this->checkUnique($faker, $flag, $collection);
        } else {
            $collection->push($data);
        }

        return $data;
    }
}
