<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileReport extends Model
{
    use HasFactory;

    /**
     * File entry not expired
     *
     * @return $id
     */
    public function scopeFileEntryActive($query)
    {
        $query->whereHas('fileEntry', function ($query) {
            $query->notExpired();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'file_entry_id',
        'ip',
        'name',
        'email',
        'reason',
        'details',
        'admin_has_viewed',
    ];

    public function fileEntry()
    {
        return $this->belongsTo(FileEntry::class, 'file_entry_id', 'id');
    }
}
