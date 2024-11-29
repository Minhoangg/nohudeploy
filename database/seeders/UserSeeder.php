<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dữ liệu mẫu cho bảng users
        $users = [
            [
                'name' => 'Super Admin',
                'phone_number' => 123456789,
                'password' => Hash::make('password123'),
                'role' => 1, // 1: Superadmin
                'coin' => 100, // 1: Superadmin
                'telegram' => '@telegam123',
                'parent_id' => null,
            ],
            [
                'name' => 'Admin',
                'phone_number' => 987654321,
                'password' => Hash::make('password123'),
                'role' => 1, // 1: Superadmin
                'coin' => 100, // 2: Admin
                'telegram' => '@telegam123admin1',
                'parent_id' => null,
            ],
            [
                'name' => 'Regular User',
                'phone_number' => 555666777,
                'password' => Hash::make('password123'),
                'role' => 1, // 1: Superadmin
                'coin' => 100, // 3: User
                'telegram' => '@telegam13admin1',
                'parent_id' => null,
            ],
            [
                'name' => 'Nguyen Văn A',
                'phone_number' => 555666777,
                'password' => Hash::make('password123'),
                'role' => 1, // 1: Superadmin
                'coin' => 100, // 3: User
                'telegram' => '@telegam143admin1',
                'parent_id' => null,
            ],
            [
                'name' => 'Phan Mạnh Em',
                'phone_number' => 555666777,
                'password' => Hash::make('password123'),
                'role' => 1, // 1: Superadmin
                'coin' => 100, // 3: User
                'telegram' => '@telegam3admin1',
                'parent_id' => null,
            ],
        ];

        // Thêm dữ liệu vào bảng users
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
