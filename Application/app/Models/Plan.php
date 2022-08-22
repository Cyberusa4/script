<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function scopeWhereFree($query)
    {
        $query->where('free_plan', 1);
    }

    public function scopeNotLifetime($query)
    {
        $query->where('interval', '!=', 3);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'color',
        'short_description',
        'interval',
        'price',
        'require_login',
        'storage_space',
        'file_size',
        'files_duration',
        'password_protection',
        'upload_at_once',
        'advertisements',
        'custom_features',
        'free_plan',
        'featured_plan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'custom_features' => 'object',
    ];
}
