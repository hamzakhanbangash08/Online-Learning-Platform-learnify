<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $fillable = ['course_id', 'title', 'content', 'video_url', 'video_path', 'position'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function hasVideo(): bool
    {
        return !empty($this->video_url) || !empty($this->video_path);
    }
}
