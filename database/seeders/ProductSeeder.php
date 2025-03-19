<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(['name' => 'Товар 1', 'price' => 100.00]);
        Product::create(['name' => 'Товар 2', 'price' => 200.00]);
        Product::create(['name' => 'Товар 3', 'price' => 300.00]);
    }
}
