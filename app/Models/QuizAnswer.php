<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
     protected $guarded = [""];


    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    //
}
