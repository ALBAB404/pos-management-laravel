<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCategorySeeder extends Seeder
{
    public function run()
    {
        $sub_categories = [
            [
                'name'        => 'Shirts',
                'slug'        => 'shirts',
                'serial'      => 1,
                'status'      => 1,
                'description' => 'something about shirts',
                'photo'       => '1.png',
                'user_id'     => 1,
                'category_id' => 1, // Mans Fashion
            ],
            [
                'name'        => 'Trousers',
                'slug'        => 'trousers',
                'serial'      => 2,
                'status'      => 1,
                'description' => 'something about trousers',
                'photo'       => '2.png',
                'user_id'     => 1,
                'category_id' => 1, // Mans Fashion
            ],
            [
                'name'        => 'Watches',
                'slug'        => 'watches',
                'serial'      => 3,
                'status'      => 1,
                'description' => 'something about watches',
                'photo'       => '3.png',
                'user_id'     => 1,
                'category_id' => 1, // Mans Fashion
            ],
            [
                'name'        => 'Dresses',
                'slug'        => 'dresses',
                'serial'      => 4,
                'status'      => 1,
                'description' => 'something about dresses',
                'photo'       => '4.png',
                'user_id'     => 1,
                'category_id' => 2, // Womens Fashion
            ],
            [
                'name'        => 'Shoes',
                'slug'        => 'shoes',
                'serial'      => 5,
                'status'      => 1,
                'description' => 'something about shoes',
                'photo'       => '5.png',
                'user_id'     => 1,
                'category_id' => 2, // Womens Fashion
            ],
            [
                'name'        => 'Bags',
                'slug'        => 'bags',
                'serial'      => 6,
                'status'      => 1,
                'description' => 'something about bags',
                'photo'       => '6.png',
                'user_id'     => 1,
                'category_id' => 2, // Womens Fashion
            ],
            [
                'name'        => 'Mobiles',
                'slug'        => 'mobiles',
                'serial'      => 7,
                'status'      => 1,
                'description' => 'something about mobiles',
                'photo'       => '7.png',
                'user_id'     => 1,
                'category_id' => 3, // Electronics
            ],
            [
                'name'        => 'Laptops',
                'slug'        => 'laptops',
                'serial'      => 8,
                'status'      => 1,
                'description' => 'something about laptops',
                'photo'       => '8.png',
                'user_id'     => 1,
                'category_id' => 3, // Electronics
            ],
            [
                'name'        => 'Furniture',
                'slug'        => 'furniture',
                'serial'      => 9,
                'status'      => 1,
                'description' => 'something about furniture',
                'photo'       => '9.png',
                'user_id'     => 1,
                'category_id' => 4, // Home & Living
            ],
            [
                'name'        => 'Decor',
                'slug'        => 'decor',
                'serial'      => 10,
                'status'      => 1,
                'description' => 'something about decor',
                'photo'       => '10.png',
                'user_id'     => 1,
                'category_id' => 4, // Home & Living
            ],
        ];

        foreach ($sub_categories as $sub_category) {
            SubCategory::create($sub_category);
        }
    }
}
