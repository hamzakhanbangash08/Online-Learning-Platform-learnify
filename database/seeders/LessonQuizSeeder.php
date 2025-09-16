<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;

class LessonQuizSeeder extends Seeder
{
    public function run(): void
    {
        $lesson = Lesson::first(); // pehla lesson uthao (ya tum specific bhi choose kar sakte ho)

        if ($lesson) {
           $quiz = Quiz::create([
    'course_id'   => $lesson->course_id, // 👈 add this
    'lesson_id'   => $lesson->id,
    'title'       => 'Sample Lesson Quiz',
    'description' => 'This is a test quiz for lesson ' . $lesson->title,
]);


            // Question 1
            $q1 = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => 'What is Laravel?',
                'question_type' => 'mcq',
            ]);

            Option::create([
                'question_id' => $q1->id,
                'option_text' => 'A PHP Framework',
                'is_correct' => true,
            ]);
            Option::create([
                'question_id' => $q1->id,
                'option_text' => 'A JavaScript Library',
                'is_correct' => false,
            ]);

            // Question 2
            $q2 = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => 'PHP is interpreted language? (True/False)',
                'question_type' => 'true_false',
            ]);

            Option::create([
                'question_id' => $q2->id,
                'option_text' => 'True',
                'is_correct' => true,
            ]);
            Option::create([
                'question_id' => $q2->id,
                'option_text' => 'False',
                'is_correct' => false,
            ]);
        }
    }
}
