<?php

namespace App\Domains\Roles\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * These fields can be filled when creating/updating a role.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'permissions_ar',
        'permissions_en',
    ];

    /**
     * Attribute type casting.
     * Ensures that permissions fields are automatically cast
     * to arrays when retrieved from the database.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'permissions_ar' => 'array',
        'permissions_en' => 'array',
    ];

    /**
     * Relationship: A role can be assigned to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
    /**
     * Normalize the permissions field into a clean array.
     *
     * @param  string|array|null  $permissions  JSON string or array from DB
     * @return array<int, string> Always returns a flat list of permission strings
     */
    public function formatPermissions($permissions): array
    {
        // If the field is already an array (thanks to model $casts), use it
        if (is_array($permissions)) {
            return array_values($permissions);
        }

        // If it's a JSON string, decode it into array
        $decoded = json_decode($permissions, true);

        // If decoding fails or result is not an array → return empty array
        if (!is_array($decoded)) {
            return [];
        }

        // Re-index array to ensure it's a clean list (no string keys)
        return array_values($decoded);
    }
}
