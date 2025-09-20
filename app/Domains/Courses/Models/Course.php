<?php

namespace App\Domains\Courses\Models;

use App\Domains\Levels\Models\Level;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    // handle created_at field to be in Y-m-d format
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes["created_at"])->locale(app()->getLocale())->diffForHumans();
    }

    // relation with Level
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
