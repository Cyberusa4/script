<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'storage_space',
        'file_size',
        'files_duration',
        'password_protection',
        'upload_at_once',
        'advertisements',
        'status',
    ];
}
