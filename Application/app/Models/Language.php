<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'native',
        'name',
        'code',
    ];

    /**
     * Relationships between blog categories & blog articles.
     */
    public function translates()
    {
        return $this->hasMany(Translate::class, 'lang', 'code');
    }

}
