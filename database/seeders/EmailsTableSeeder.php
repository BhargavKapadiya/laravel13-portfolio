<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appName = ucwords(config('app.name'));

        EmailTemplate::firstOrCreate([
            'id' => 1,
        ], [
            'title' => "Reset Password",
            'subject' => "Reset Password",
            'body' => "<p>Hello {user_name},</p>
            <p>You have received this email because we received a password reset request for your account. Please click on the link below to reset your password.</p>
            <p><a href='{password_reset_link}'>Click Here</a></p>
            <p>This password reset link will expire in {expiry_time} minutes.</p>
            <p>If you did not request a password reset, please get in touch with us at support@example.com and we will investigate further.</p> <p>Best regards,<br />" . $appName . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 2,
        ], [
            'title' => "Reset password (User)",
            'subject' => "Reset Password",
            'body' => "<p>Hello {user_name},</p><p>We received a request to reset the password for your " . $appName . " account. To proceed with the password reset, please use the following verification code:</p><p><strong>Verification Code:</strong> {code}</p><p>If you have any questions or concerns, please contact our support team at support@example.com.</p><p>Thank you for choosing " . $appName . ". We value your security and are here to help.</p><p>Best regards,<br />" . $appName . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 3,
        ], [
            'title' => "Welcome mail",
            'subject' => "Welcome to " . $appName . "!",
            'body' => "<p>Hi {user_name}!</p><p>Welcome to " . $appName . " — we're thrilled to have you on board!.</p><p>Have any questions? Just shoot us an email at support@example.com! We are always here to help.</p><p>We’re always here to help.</p><p>Best regards,<br />" . $appName . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 4,
        ], [
            'title' => "Account Activate (User)",
            'subject' => "Your account has been activated of " . $appName . "",
            'body' => "<p>Hello {user_name},</p><p>We&rsquo;re excited to inform you that your account has been successfully activated!</p><p>You can now log in and start using your account at your convenience.</p><p>👉 <strong>Login:</strong>&nbsp;<a href=\"{login_url}\">Click here</a></p><p>If you have any questions or need assistance, feel free to contact our support team.</p><p>Thank you for joining us!</p><p>Best regards,<br />" . $appName . "</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 5,
        ], [
            'title' => "Account Suspended (User)",
            'subject' => "Account suspended of " . $appName . "",
            'body' => "<p>Hello {user_name},</p><p>We regret to inform you that your account has been <strong>suspended</strong> by the <strong>" . $appName . " Team</strong>.</p><p>For more information regarding this action or to resolve the issue, please contact us at:&nbsp;<strong>support@example.com</strong></p><p>We&rsquo;re here to help and will do our best to assist you promptly.</p><p>Thank you for your understanding.</p><p>Best regards,<br />" . $appName . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 6,
        ], [
            'title' => "Contact Enquiry",
            'subject' => "Enquiry",
            'body' => "<p>Hello!</p><p>You have received a new enquiry through the contact form.</p><p>Name: {name}<br />Email: {email}<br />Subject: {subject}<br />Message: {message}</p><p>Please follow up with the user at your earliest convenience.</p><p>Best regards,<br />" . $appName . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 7,
        ], [
            'title' => "User account created by admin (User)",
            'subject' => "Your account is created on " . $appName . "",
            'body' => "<p>Hello!</p><p>Welcome to " . $appName . "! We are excited to inform you that your account has been created in our system.</p><p><a href=\"{activation_link}\"><strong>Click here</strong></a>&nbsp;to set up your account password.</p><p>If you have any questions or concerns, please contact our support team at support@example.com.</p><p>Thank you for choosing " . $appName . ". We appreciate your trust, and we're excited to have you as part of our community.</p><p>Best regards,<br />" . $appName . " Team</p>",
        ]);
    }
}
