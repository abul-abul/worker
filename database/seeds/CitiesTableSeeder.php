<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		City::truncate();
		$cities = config('cities');
		foreach ($cities as $city) {
			City::insert([
				'country_code' => $city['country'],
				'region_code' => $city['region'],
				'city' => $city['city'],
				'latitude' => $city['latitude'],
				'longitude' => $city['longitude'],
			]);
		}
    }
}
