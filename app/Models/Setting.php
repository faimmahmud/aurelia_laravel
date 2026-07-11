<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'autoload',
    ];

    /**
     * If your database table is company_settings,
     * uncomment the line below.
     */
    // protected $table = 'company_settings';

    /**
     * Get setting by key.
     */
    public static function get(string $key, $default = null)
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            return static::where('key', $key)->value('value') ?? $default;
        });
    }

    /**
     * Save or update setting.
     */
    public static function set(string $key, $value, string $type = 'text'): void
    {
        $group = explode('.', $key)[0] ?? 'general';

        static::updateOrCreate(
            [
                'key' => $key,
            ],
            [
                'group' => $group,
                'value' => $value,
                'type' => $type,
                'autoload' => true,
            ]
        );

        Cache::forget("setting.{$key}");
    }

    /**
     * Get all settings by group.
     */
    public static function group(string $group)
    {
        return static::where('group', $group)
            ->pluck('value', 'key');
    }

    /**
     * Clear cached settings.
     */
    public static function clearCache(): void
    {
        static::pluck('key')->each(function ($key) {
            Cache::forget("setting.{$key}");
        });
    }
}
