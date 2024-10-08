<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'phone'    => '01686381998',
            'password' => Hash::make('123456789'),
            'role_id'  => 1,
        ];

        User::create($data);
    }
}
