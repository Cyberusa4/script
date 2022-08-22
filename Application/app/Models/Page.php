<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * Validation rules
     *
     * @return array
     */
    public const VALIDATION_RULES = [
        'lang' => ['required', 'string', 'max:3'],
        'title' => ['required', 'max:255', 'min:2'],
        'content' => ['required', 'min:2'],
        'short_description' => ['required', 'max:200', 'min:2'],
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'lang',
        'title',
        'slug',
        'content',
        'short_description',
        'views',
    ];
}
