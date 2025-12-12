<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Tạo 1 tài khoản Admin
        User::factory()->create([
            'name' => 'Admin Hậu',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'), // Mật khẩu là 12345678
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'test@gmail.com',
            'password' => '00000000',
            'role' => 'admin',
            'status' => 'active',
        ]);
        // Tạo thêm 10 user giả để test danh sách
        User::factory(10)->create([
            'role' => 'user',
            'status' => 'active',
        ]);

    }
}
