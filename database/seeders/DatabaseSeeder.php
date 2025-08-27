<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Pehle roles create kar lein (agar spatie laravel-permission use kar rahe ho)
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'instructor']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);


        // 🔑 Fixed admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('admin123'), // 👈 default admin123
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');
        // Demo users with roles
        User::factory()->count(10)->create();


        $this->call([
            RoleSeeder::class,
            CourseSeeder::class,

        ]);
    }
}
