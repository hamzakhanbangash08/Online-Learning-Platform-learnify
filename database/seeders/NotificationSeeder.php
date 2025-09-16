<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        \App\Models\User::all()->each(function ($user) {
            Notification::create([
                'user_id' => $user->id,
                'message' => "Welcome {$user->name}, your account has been created!",
                'is_read' => false,
            ]);

            Notification::create([
                'user_id' => $user->id,
                'message' => "System update completed successfully.",
                'is_read' => true,
            ]);
        });
    }
}
