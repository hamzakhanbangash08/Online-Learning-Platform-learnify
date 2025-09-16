<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    //
    protected $fillable = ['user_id', 'title', 'description', 'price', 'thumbnail_path', 'category_id'];
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('position');
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot('enrolled_at');
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

   public function category()
{
    return $this->belongsTo(Category::class);
}

}
