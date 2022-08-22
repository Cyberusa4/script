<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use HasFactory;
    // Disable timestamps
    public $timestamps = false;
    /**
     * Get additionals tings by key
     */
    public static function selectAdditionals($key)
    {
        $setting = Additional::where('key', $key)->first();
        if ($setting) {
            return $setting->value;
        }
        return false;
    }

    /**
     * Update additionals from table.
     */
    public static function updateAdditionals($key, $value)
    {
        $setting = Additional::where('key', $key)->first();
        if ($setting) {
            $setting->value = $value;
            return $setting->save();
        }
        return false;
    }
}
