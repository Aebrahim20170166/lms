<?php

namespace App\Domains\Students\Models;

use App\Domains\Cities\Models\City;
use App\Domains\Countries\Models\Country;
use App\Domains\Levels\Models\Level;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function level()   { return $this->belongsTo(Level::class, 'level_id'); }
    public function city()    { return $this->belongsTo(City::class, 'city_id'); }
    public function country() { return $this->belongsTo(Country::class, 'country_id'); }

    // handle created_at field to be in Y-m-d format
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes["created_at"])->locale(app()->getLocale())->diffForHumans();
    }
}
