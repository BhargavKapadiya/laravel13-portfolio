<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\DynamicMail;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public static function dynamicEmail($data)
    {
        $admin_email = config('constant.admin_email');

        if (!empty($admin_email)) {
            $admin_email = explode(',', $admin_email);
        }

        $cc_emails = [];
        $email_body = $email_subject  = $user_name = $user_email  = $attachment  = '';

        $email = EmailTemplate::findOrFail($data['email_id']);
        if (!$email) {
            return "";
        }

        if (isset($data['user_id']) && $data['user_id'] == 1) {
            $user_email = $admin_email;
            $user_name = "Admin";
        } else {
            if (isset($data['user_email'])) {
                $user_name = $data['user_name'] ?? "";
                $user_email = $data['user_email'] ?? "";
            } else if (isset($data['user_id'])) {
                $user = User::select('id', 'role_id', 'email', 'name')->where('id', $data['user_id'])->first();
                $user_email = $user->email ?? null;
                $user_name = $user->name ?? null;
            }
        }

        if ($email && $user_email) {
            $email_subject = $email->subject;
            $email_body = $email->body;

            // Get email template body content as per requirement
            switch ($email->id) {
                case 1:
                    // Reset password
                    // Receiver - User / Admin
                    // find code in app/Notifications/CustomResetPassword.php
                    break;
                case 2:
                    // Forgot password mail from application
                    // Receiver - User
                    $email_body = str_replace('{user_name}', $user_name, $email_body);
                    $email_body = str_replace('{code}', $data['code'] ?? "", $email_body);
                    break;
                case 3:
                    // Welcome email After verify account / Password setup
                    // Receiver - User
                    $email_body = str_replace('{user_name}', $user_name, $email_body);
                    // find code in app/Notifications/CustomVerifyEmail.php
                    break;
                case 4:
                    // Account Activate from admin
                    // Receiver - User
                    $email_body = str_replace('{user_name}', $user_name, $email_body);
                    $email_body = str_replace('{login_url}', route('login'), $email_body);
                    break;
                case 5:
                    // Account suspend from admin
                    // Receiver - User
                    $email_body = str_replace('{user_name}', $user_name, $email_body);
                    break;
                case 6:
                    // Contact enquiry from web / app
                    // Receiver - admin
                    $email_body = str_replace('{user_name}', $user_name, $email_body);
                    $email_body = str_replace('{name}', $data['name'], $email_body);
                    $email_body = str_replace('{email}', $data['email'], $email_body);
                    $email_body = str_replace('{message}', $data['message'], $email_body);
                    break;
                case 7:
                    // User created from Admin then send activation link to user
                    // Receiver - User
                    // find code in app/Notifications/CustomVerifyEmail.php
                    $email_body = str_replace('{user_name}', $user_name, $email_body);
                    $email_body = str_replace('{activation_link}', $data['link'], $email_body);
                    break;
                default:
                    $email_body = "No content";
                    break;
            }

            if (isset($data['attachment'])) {
                $attachment = $data['attachment'];
            }

            // Set data in content array to pass in view
            $content = [
                'subject' => $email_subject,
                'body' => $email_body,
                'attachment' => $attachment,
            ];

            if (isset($data['preview'])) {
                return $content;
            }

            if (isset($data['cc_emails'])) {
                $cc_emails = $data['cc_emails'];
            }

            if (isset($cc_emails) && $cc_emails != '') {
                Mail::to($user_email, $user_name)
                    ->cc($cc_emails)
                    ->send(new DynamicMail($content));
            } else {
                Mail::to($user_email, $user_name)
                    ->send(new DynamicMail($content));
            }
        } else {
            return false;
        }
        return false;
    }
}
