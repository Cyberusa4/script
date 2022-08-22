<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'lang',
        'group_name',
        'key',
        'value',
    ];

    /**
     * Relationships between languages & translates.
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'code');
    }

}
