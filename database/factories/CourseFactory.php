<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 0, 5000),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id, // assign random instructor
            'thumbnail_path' => null,
        ];
    }
}
