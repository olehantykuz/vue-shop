<?php

use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use App\Models\Product;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategories = SubCategory::all();
        if ($subCategories->isNotEmpty()) {
            factory(Product::class, 77)->create();
        }
    }
}
