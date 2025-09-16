<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Roles create kar lo
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $instructor = Role::firstOrCreate(['name' => 'instructor']);
        $student = Role::firstOrCreate(['name' => 'student']);

        // Default admin user with extra fields
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
                'city' => 'Karachi', // default city
                'cnic' => '12345-1234567-1', // default CNIC
                'image' => 'https://via.placeholder.com/200', // placeholder image
                'email_verified_at' => now(),
            ]
        );

        $user->assignRole($admin);
    }
}
