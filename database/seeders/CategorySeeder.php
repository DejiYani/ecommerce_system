<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Beverages', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Snacks', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dairy Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Frozen Foods', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Bakery', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Personal Care', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Household Supplies', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Canned Goods', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Condiments', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'School & Office Supplies', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
