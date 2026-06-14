<?php

return [
    'admin_email' => env('ADMIN_EMAIL'),
    'asset_version' => 1.0,
    'recaptcha_enabled' => env('RECAPTCHA_ENABLED', false),

    'profile_image_url' => "/upload/profile/",
    'cms_page_url' => "/upload/pages/",
    'blog_url' => "/upload/blogs/",
    'temp_file_url' => "/upload/temp/",

    'is_send_enquiry_email_to_admin' => false,

    'default_country_code' => "+91",

    'user_status' => [
        0 => 'Pending',
        1 => 'Active',
        2 => 'Inactive',
    ],
];
