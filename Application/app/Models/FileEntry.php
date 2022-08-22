<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileEntry extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $touches = ['parentEntry'];

    protected $cascadeDeletes = ['childEntries'];

    /**
     * Get the next id
     *
     * @return $id
     */
    public function getNextId()
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'file_entries'");
        return $statement[0]->Auto_increment;
    }

    /**
     * Get only none expired
     *
     * @return $id
     */
    public function scopeNotExpired($query)
    {
        $query->where(function ($query) {
            $query->where('expiry_at', '>', Carbon::now())->orWhereNull('expiry_at');
        });
    }

    /**
     * Get none folder
     *
     * @return $id
     */
    public function scopeNotFolder($query)
    {
        $query->where('type', '!=', 'folder');
    }

    /**
     * Get users entries
     *
     * @return $id
     */
    public function scopeUserEntry($query)
    {
        $query->where('user_id', '!=', null);
    }

    /**
     * Get guests entries
     *
     * @return $id
     */
    public function scopeGuestEntry($query)
    {
        $query->where('user_id', null);
    }

    /**
     * File can be previewed
     *
     * @return $id
     */
    public function scopeHasPreview($query)
    {
        $query->whereIn('type', ['image', 'pdf']);
    }

    /**
     * File without parent
     *
     * @return $id
     */
    public function scopeHasNoParent($query)
    {
        $query->where('parent_id', null);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ip',
        'shared_id',
        'user_id',
        'parent_id',
        'storage_provider_id',
        'name',
        'filename',
        'mime',
        'size',
        'extension',
        'type',
        'path',
        'path_ids',
        'link',
        'access_status',
        'password',
        'downloads',
        'views',
        'admin_has_viewed',
        'expiry_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function parentEntry()
    {
        return $this->belongsTo(fileEntry::class, 'parent_id', 'id');
    }

    public function childEntries()
    {
        return $this->hasMany(FileEntry::class, 'parent_id', 'id');
    }

    public function storageProvider()
    {
        return $this->belongsTo(StorageProvider::class, 'storage_provider_id', 'id');
    }

    public function reports()
    {
        return $this->hasMany(FileReport::class, 'file_entry_id', 'id');
    }
}
