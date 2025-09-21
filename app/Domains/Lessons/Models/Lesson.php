<?php

namespace App\Domains\Lessons\Models;

use App\Domains\Courses\Models\Course;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    // relationship with course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // handle created_at field to be in Y-m-d format
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes["created_at"])->locale(app()->getLocale())->diffForHumans();
    }

}
