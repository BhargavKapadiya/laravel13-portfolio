<?php

namespace App\Models;

use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationReceiver extends Model
{
    use HasUid, SoftDeletes;

    protected $fillable = ["notification_id", "receiver_id", "status"];

    protected $hidden = ["notification_id", "receiver_id", "created_at", "updated_at", "deleted_at"];

    /**
     * Get the user that owns the NotificationReceiver
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}