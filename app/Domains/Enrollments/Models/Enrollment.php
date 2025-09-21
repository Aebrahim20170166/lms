<?php

namespace App\Domains\Enrollments\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'lesson_id',
        'student_id',
        'tutor_id',
        'status',
        'enrollment_date_time',
        'notes',
    ];

    protected $casts = [
        'enrollment_date_time' => 'datetime',
    ];
    // public function lesson()
    // {
    //     return $this->belongsTo(lesson::class);
    // }
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}
