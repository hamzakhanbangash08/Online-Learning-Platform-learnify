<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pehle roles create kar lo (Spatie laravel-permission)
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'instructor']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'student']);

        // 🔑 Fixed admin user with extra fields
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'              => 'Super Admin',
                'password'          => bcrypt('admin123'), // default password
                'city'              => 'Karachi',          // default city
                'cnic'              => '12345-1234567-1',  // default CNIC
                'image'             => 'https://via.placeholder.com/200', // placeholder image
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Demo users with roles (factory will handle city, cnic, image)
        User::factory()->count(4)->create();

        // Call other seeders
        $this->call([
            RoleSeeder::class,
            CourseSeeder::class,
            LessonQuizSeeder::class,
            SettingsTableSeeder::class,
        ]);
    }
}
