<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'cnic',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function coursesEnrolled()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot('enrolled_at');
    }

    public function coursesTaught()
    {
        return $this->hasMany(Course::class, 'user_id'); // agar user instructor hai
    }

    /// Notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class);;
    }
}
