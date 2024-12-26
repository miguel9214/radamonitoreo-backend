<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Get the value of a configuration by key.
     *
     * @param string $key
     * @return string|null
     */
    public static function getValueByKey(string $key): ?string
    {
        $config = self::where('key', $key)->first();
        return $config ? $config->value : null;
    }
}
