<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    // Disable timestamps
    public $timestamps = false;
    /**
     * Get settings by key
     */
    public static function selectSettings($key)
    {
        $setting = Settings::where('key', $key)->first();
        if ($setting) {
            return $setting->value;
        }
        return false;
    }

    /**
     * Update settings from table.
     */
    public static function updateSettings($key, $value)
    {
        $setting = Settings::where('key', $key)->first();
        if ($setting) {
            $setting->value = $value;
            return $setting->save();
        }
        return false;
    }
}
