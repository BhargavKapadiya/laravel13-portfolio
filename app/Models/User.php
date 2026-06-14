<?php

namespace App\Models;

use App\Traits\HasUid;
use App\Helpers\Helper;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use  HasUid, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_code',
        'phone_number',
        'photo',
        'is_complete_profile',
        'is_active',
        'reset_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = [
        'photo_url',
    ];

    /**
     * GetPhotoUrlAttribute
     *
     * @author CK
     * @return void
     */
    public function getPhotoUrlAttribute()
    {
        return isset($this->attributes['photo']) && $this->attributes['photo'] != null ? Helper::media(config('constant.profile_image_url') . $this->attributes['photo']) : Helper::assets('assets/images/default-user.jpg');
    }

    /**
     * login_devices
     *
     * @return void
     */
    public function login_devices()
    {
        return $this->hasMany(UserLoginDevice::class, 'user_id', 'id');
    }

    /**
     * Send activation mail
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }

    /**
     * Reset password mail
     *
     * @param  mixed $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    /**
     * When Verify user his account then update the is active status
     *
     * @return void
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill(
            [
                'email_verified_at' => $this->freshTimestamp(),
                'is_active' => 1,
            ]
        )->save();
    }

    // This is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            // Before delete() method call this
            if (isset($model->login_devices) && !empty($model->login_devices)) {
                foreach ($model->login_devices as $row) {
                    $row->delete();
                }
            }
        });
    }
}
