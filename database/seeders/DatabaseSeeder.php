<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProductSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
