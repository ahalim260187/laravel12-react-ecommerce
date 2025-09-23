<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Top-level category
            [
                'name' => 'Smartphones',
                'department_id' => 1,
                'parent_id' => null,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Subcategories of Smartphones (depth 2)
            [
                'name' => 'Android',
                'department_id' => 1,
                'parent_id' => 1, // parent is Smartphones
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'iOS',
                'department_id' => 1,
                'parent_id' => 1, // parent is Smartphones
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Subcategory of Android (depth 3)
            [
                'name' => 'Samsung',
                'department_id' => 1,
                'parent_id' => 2, // parent is Android
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Another top-level category
            [
                'name' => 'Laptops',
                'department_id' => 2,
                'parent_id' => null,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Subcategory of Laptops
            [
                'name' => 'Gaming Laptops',
                'department_id' => 2,
                'parent_id' => 5, // parent is Laptops
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Subcategory of Gaming Laptops
            [
                'name' => 'Alienware',
                'department_id' => 2,
                'parent_id' => 6, // parent is Gaming Laptops
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
