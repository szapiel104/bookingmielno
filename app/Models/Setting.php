<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    public static function get($key, $default = null)
    {
        try {
            $setting = self::where('key', $key)->first();
        } catch (QueryException $exception) {
            return $default;
        }
        
        if (!$setting) {
            return $default;
        }

        if ($setting->type === 'boolean') {
            return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
        } elseif ($setting->type === 'number') {
            return is_numeric($setting->value) ? (float)$setting->value : $default;
        } elseif ($setting->type === 'json') {
            return json_decode($setting->value, true);
        }

        return $setting->value;
    }

    public static function set($key, $value, $type = 'text')
    {
        if (is_bool($value)) {
            $value = $value ? '1' : '0';
            $type = 'boolean';
        } elseif (is_array($value) || is_object($value)) {
            $value = json_encode($value);
            $type = 'json';
        }

        try {
            return self::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => $type]
            );
        } catch (QueryException $exception) {
            return null;
        }
    }
}
