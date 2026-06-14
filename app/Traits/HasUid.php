<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUid
{
    /**
     * Boot the trait.
     */
    protected static function bootHasUid()
    {
        static::creating(function ($model) {
            if (empty($model->uid)) {
                $model->uid = (string) Str::ulid();
            }
        });
    }

    /**
     * Use uid instead of id for route model binding.
     */
    public function getRouteKeyName()
    {
        return 'uid';
    }
}