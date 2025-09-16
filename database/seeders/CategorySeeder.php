<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $categories = [
            ['name' => 'Web Development', 'slug' => 'web-development', 'icon' => 'bi bi-code-slash'],
            ['name' => 'Graphic Design', 'slug' => 'graphic-design', 'icon' => 'bi bi-easel2-fill'],
            ['name' => 'Business', 'slug' => 'business', 'icon' => 'bi bi-briefcase-fill'],
            ['name' => 'Data Science', 'slug' => 'data-science', 'icon' => 'bi bi-bar-chart-line-fill'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
