<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();
		$countries = config('countries');
			foreach ($countries as $country) {
				Country::insert([
					'code' => strtolower( $country['code'] ), 
					'name' => $country['name'], 
					'phonenumber_prefix' => ltrim($country['d_code'], '+') 
			]);
		}
    }
}
