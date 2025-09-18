<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name',
        'permissions_ar',
        'permissions_en',
    ];


    /**
     * Type casting for JSON columns.
     * Ensures permissions_* are arrays when accessed.
     */
    protected $casts = [
        'permissions_ar' => 'array',
        'permissions_en' => 'array',
    ];
}
