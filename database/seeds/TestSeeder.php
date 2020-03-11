<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
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
        if (Category::count() > 0) {
            DB::table('products')->truncate();
            factory(Product::class, 777)->create();
        }
    }
}
