<?php

namespace App\Models;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLoginDevice extends Model
{
    use HasUid, SoftDeletes;

    protected $fillable = [
        'user_id',
        'fcm_token',
        'platform',
        'device_model',
        'device_manufacture',
        'device_os_version',
        'login_date',
        'logout_date',
        'is_signout'
    ];

    /**
     * Get the user that owns the UserLoginDevice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}