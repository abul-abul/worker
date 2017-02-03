<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
		$categories = [
			['name' => 'Automotive', 'description' => '1'],
			['name' => 'Air-conditioning', 'description' => '2'],
			['name' => 'Beauty & Styling', 'description' => '4'],
			['name' => 'Borehole drilling', 'description' => '31'],
			['name' => 'Carpentry', 'description' => '9'],

			['name' => 'Cleaning & Housekeeping', 'description' => '5'],
			['name' => 'Computer,Hardware & Peripherals', 'description' => '8'],
			['name' => 'Consumer Appliances & Gadgets', 'description' => '7'],
			['name' => 'Electrical & Wiring', 'description' => '10'],
			['name' => 'Fencing', 'description' => '32'],

			['name' => 'Flooring & Tiling', 'description' => '11'],
			['name' => 'Food & beverage catering', 'description' => '27'],
			['name' => 'Gardening & Landscaping', 'description' => '12'],
			['name' => 'Househelp & Maids', 'description' => '6'],
			['name' => 'Mobile & Tablets', 'description' => '17'],

			['name' => 'Packing & Moving', 'description' => '20'],
			['name' => 'Pest control', 'description' => '19'],
			['name' => 'Photography & Video Filming', 'description' => '21'],
			['name' => 'Plumbing & Drainage', 'description' => '22'],
			['name' => 'Printing & Design', 'description' => '23'],

			['name' => 'Roofing', 'description' => '21'],
			['name' => 'Security Services', 'description' => '28'],
			['name' => 'Tutoring', 'description' => '33'],
			['name' => 'Wedding', 'description' => '29'],
			['name' => 'Others', 'description' => '30'],
        ];
		foreach ($categories as $category) {
			Category::insert([
				$category
			]);
		}
    }
}
