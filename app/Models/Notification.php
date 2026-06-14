<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Traits\HasUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasUid, SoftDeletes;

    protected $fillable = ["type", "title", "text", "sender_id", "redirect_on", "others"];

    protected $hidden = ["sender_id", "updated_at", "deleted_at"];

    /**
     * Interact with the redirect_on.
     */
    protected function redirectOn(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value !== null ? Helper::getEncryptedId($value) : null,
        );
    }

    /**
     * Get the user associated with the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id')->withTrashed();
    }

    /**
     * Get all of the receivers for the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivers(): HasMany
    {
        return $this->hasMany(NotificationReceiver::class, 'notification_id', 'id');
    }

    /**
     * Get single receiver for the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function receiver(): HasOne
    {
        return $this->hasOne(NotificationReceiver::class, 'notification_id', 'id');
    }

    // This is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (isset($model->receivers) && !empty($model->receivers)) {
                foreach ($model->receivers as $row) {
                    $row->delete();
                }
            }
        });
    }
}