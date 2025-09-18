<?php

namespace App\Domains\Cities\Models;

use App\Domains\Countries\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_en',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes["created_at"])->locale(app()->getLocale())->diffForHumans();
    }
}
