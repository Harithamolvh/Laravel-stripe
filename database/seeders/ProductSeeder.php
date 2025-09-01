<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Product 1', 'price' => 10.00, 'description' => 'Description for Product 1'],
            ['name' => 'Product 2', 'price' => 20.00, 'description' => 'Description for Product 2'],
            ['name' => 'Product 3', 'price' => 30.00, 'description' => 'Description for Product 3'],
            ['name' => 'Product 4', 'price' => 40.00, 'description' => 'Description for Product 4'],
            ['name' => 'Product 5', 'price' => 50.00, 'description' => 'Description for Product 5'],
            ['name' => 'Product 6', 'price' => 30.00, 'description' => 'Description for Product 6'],
            ['name' => 'Product 7', 'price' => 30.00, 'description' => 'Description for Product 7'],
            ['name' => 'Product 8', 'price' => 30.00, 'description' => 'Description for Product 8'],
            ['name' => 'Product 9', 'price' => 30.00, 'description' => 'Description for Product 9'],
            ['name' => 'Product 10', 'price' => 30.00, 'description' => 'Description for Product 10'],
        ];

        \App\Models\Product::insert($data);
    }

}
