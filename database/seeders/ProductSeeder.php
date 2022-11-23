<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(100)
            ->hasCategories(2)
            ->hasColors(4)
            ->hasTypes(3)
            ->hasSizes(10)
            ->hasImages(3)
            ->hasReviews(100)
            ->create();
    }
}
