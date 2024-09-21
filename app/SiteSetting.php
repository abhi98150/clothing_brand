<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $guarded = ['id'];

    public static function set($key, $value)
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
