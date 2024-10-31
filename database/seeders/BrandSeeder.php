<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name'        => 'Mans Fashion',
                'slug'        => 'mans-fashion',
                'serial'      => 1,
                'status'      => 1,
                'description' => 'something about mans fashion',
                'photo'       => '1.png',
                'user_id'     => 1,
            ],
            [
                'name'        => 'Womens Fashion',
                'slug'        => 'womens-fashion',
                'serial'      => 2,
                'status'      => 1,
                'description' => 'something about womens fashion',
                'photo'       => '2.png',
                'user_id'     => 1,
            ],
            [
                'name'        => 'Electronics',
                'slug'        => 'electronics',
                'serial'      => 3,
                'status'      => 1,
                'description' => 'something about electronics',
                'photo'       => '3.png',
                'user_id'     => 1,
            ],
            [
                'name'        => 'Home & Living',
                'slug'        => 'home-living',
                'serial'      => 4,
                'status'      => 1,
                'description' => 'something about home & living',
                'photo'       => '4.png',
                'user_id'     => 1,
            ],
            [
                'name'        => 'Sports & Fitness',
                'slug'        => 'sports-fitness',
                'serial'      => 5,
                'status'      => 1,
                'description' => 'something about sports & fitness',
                'photo'       => '5.png',
                'user_id'     => 1,
            ],
            [
                'name'        => 'Health & Beauty',
                'slug'        => 'health-beauty',
                'serial'      => 6,
                'status'      => 1,
                'description' => 'something about health & beauty',
                'photo'       => '6.png',
                'user_id'     => 1,
            ],
            [
                'name'        => 'Toys & Games',
                'slug'        => 'toys-games',
                'serial'      => 7,
                'status'      => 1,
                'description' => 'something about toys & games',
                'photo'       => '7.png',
                'user_id'     => 1,
            ],
            [
                'name'        => 'Books & Stationery',
                'slug'        => 'books-stationery',
                'serial'      => 8,
                'status'      => 1,
                'description' => 'something about books & stationery',
                'photo'       => '8.png',
                'user_id'     => 1,
            ],
            [
                'name'        => 'Groceries',
                'slug'        => 'groceries',
                'serial'      => 9,
                'status'      => 1,
                'description' => 'something about groceries',
                'photo'       => '9.png',
                'user_id'     => 1,
            ],
            [
                'name'        => 'Automotive',
                'slug'        => 'automotive',
                'serial'      => 10,
                'status'      => 1,
                'description' => 'something about automotive',
                'photo'       => '10.png',
                'user_id'     => 1,
            ],
        ];

        foreach ($brands as $Brand) {
            Brand::create($Brand);
        }
    }
}
