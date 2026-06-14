<?php

namespace App\Notifications;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user_name = $notifiable->name;

        $email = EmailTemplate::findOrFail(1);
        $email_subject  = $email->subject;
        $email_body     = $email->body;
        $email_body     = str_replace('{user_name}', $user_name, $email_body);
        $email_body     = str_replace('{password_reset_link}', route('admin.password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]), $email_body);
        $email_body     = str_replace('{expiry_time}', config('auth.passwords.' . config('auth.defaults.passwords') . '.expire'), $email_body);

        return (new MailMessage)
            ->subject($email_subject)
            ->markdown('emails.dynamicEmail', ['content' => ['body' => $email_body]]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
