<?php

namespace App\Domains\Levels\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    // handle created_at field to be in Y-m-d format
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes["created_at"])->locale(app()->getLocale())->diffForHumans();
    }
}
