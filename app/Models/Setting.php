<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key with optional default.
     */
    public static function get(string $key, $default = null)
    {
        $row = static::where('key', $key)->first();
        if (! $row) return $default;
        return $row->value;
    }

    /**
     * Set or update a setting value.
     */
    public static function set(string $key, $value)
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
