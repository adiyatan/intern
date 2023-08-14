<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class orders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [];
        for ($i = 0; $i < 10000; $i++) {
            $orders[] = [
                'product_code' => 'PRODUCT-' . rand(1, 4),
                'qty' => rand(1, 100),
                'price' => rand(1000, 100000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('products')->insert($orders);
    }
}