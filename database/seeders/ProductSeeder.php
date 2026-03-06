<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            // Beverages
            ['Coca Cola 1.5L', '100000000001', 'Beverages', 50, 85.00],
            ['Pepsi 1.5L', '100000000002', 'Beverages', 40, 82.00],
            ['Bottled Water 500ml', '100000000003', 'Beverages', 100, 20.00],

            // Snacks
            ['Lay\'s Classic Chips', '100000000004', 'Snacks', 60, 35.00],
            ['Oreo Cookies', '100000000005', 'Snacks', 45, 25.00],

            // Dairy Products
            ['Fresh Milk 1L', '100000000006', 'Dairy Products', 30, 110.00],
            ['Cheddar Cheese 200g', '100000000007', 'Dairy Products', 20, 95.00],

            // Frozen Foods
            ['Frozen Hotdog 1kg', '100000000008', 'Frozen Foods', 25, 180.00],
            ['Chicken Nuggets 500g', '100000000009', 'Frozen Foods', 35, 150.00],

            // Bakery
            ['Loaf Bread', '100000000010', 'Bakery', 40, 55.00],
            ['Chocolate Cake Slice', '100000000011', 'Bakery', 20, 75.00],

            // Personal Care
            ['Shampoo 170ml', '100000000012', 'Personal Care', 50, 120.00],
            ['Toothpaste 150g', '100000000013', 'Personal Care', 45, 90.00],

            // Household Supplies
            ['Dishwashing Liquid 500ml', '100000000014', 'Household Supplies', 30, 65.00],
            ['Laundry Detergent 1kg', '100000000015', 'Household Supplies', 20, 150.00],

            // Canned Goods
            ['Canned Tuna 155g', '100000000016', 'Canned Goods', 60, 45.00],
            ['Corned Beef 210g', '100000000017', 'Canned Goods', 55, 55.00],

            // Condiments
            ['Soy Sauce 1L', '100000000018', 'Condiments', 25, 70.00],
            ['Tomato Ketchup 500g', '100000000019', 'Condiments', 30, 60.00],

            // School & Office Supplies
            ['Notebook 80 Leaves', '100000000020', 'School & Office Supplies', 100, 35.00],
            ['Ballpen Blue', '100000000021', 'School & Office Supplies', 200, 10.00],
        ];

        foreach ($products as $item) {

            $category = Category::where('name', $item[2])->first();

            if ($category) {
                Product::create([
                    'name' => $item[0],
                    'barcode' => $item[1],
                    'category_id' => $category->id,
                    'stock' => $item[3],
                    'price' => $item[4],
                ]);
            }
        }
    }
}
