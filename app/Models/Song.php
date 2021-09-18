<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Song extends Model
{
    protected $keyType = 'uuid';
    public $incrementing = false;
    protected $guarded = [];
    public function getInfoAttribute($value)
    {
        return json_decode($value, false, JSON_THROW_ON_ERROR);
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($song) {
            $song->{$song->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
