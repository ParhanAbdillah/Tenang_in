<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebConfig extends Model
{
    protected $fillable = ['key', 'value'];

    // Fungsi sakti supaya manggil di Blade tinggal WebConfig::get('key')
    public static function get($key, $default = null)
    {
        $config = self::where('key', $key)->first();
        return $config ? $config->value : $default;
    }
}
