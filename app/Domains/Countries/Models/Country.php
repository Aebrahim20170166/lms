<?php

namespace App\Domains\Countries\Models;

use App\Domains\Cities\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_en',
        'code',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    // handle created_at field to be in Y-m-d format
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes["created_at"])->locale(app()->getLocale())->diffForHumans();
    }
}
