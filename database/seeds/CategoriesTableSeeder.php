<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategoriesByCategory = [
            'sport' => [
                'inventory',
                'clothes',
            ],
            'office' => [
                'glue',
                'pencil',
                'pen',
            ],
        ];

        foreach ($subCategoriesByCategory as $category => $subCategories) {
            /** @var Category $category */
            $category = Category::firstOrCreate(['name' => $category]);

            foreach ($subCategories as $name) {
                $category->subCategories()
                    ->firstOrCreate(['name' => $name]);
            }
        }
    }
}
