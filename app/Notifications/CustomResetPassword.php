<?php

namespace App\Notifications;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $user_name = $notifiable->name;

        $email = EmailTemplate::findOrFail(1);
        $email_subject  = $email->subject;
        $email_body     = $email->body;
        $email_body     = str_replace('{user_name}', $user_name, $email_body);
        $email_body     = str_replace('{password_reset_link}', route(($notifiable->role_id == SUPER_ADMIN_ROLE ? 'admin.password.reset' : 'password.reset'), ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]), $email_body);
        $email_body     = str_replace('{expiry_time}', config('auth.passwords.' . config('auth.defaults.passwords') . '.expire'), $email_body);

        return (new MailMessage)
            ->subject($email_subject)
            ->markdown('emails.dynamicEmail', ['content' => ['body' => $email_body]]);
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
