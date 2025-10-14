<?php

return [
    'default' => nexus_env('CAPTCHA_DRIVER', 'image'),

    'drivers' => [
        'image' => [
            'class' => \App\Services\Captcha\Drivers\ImageCaptchaDriver::class,
        ],

        'cloudflare_turnstile' => [
            'class' => \App\Services\Captcha\Drivers\TurnstileCaptchaDriver::class,
            'site_key' => nexus_env('TURNSTILE_SITE_KEY'),
            'secret_key' => nexus_env('TURNSTILE_SECRET_KEY'),
            'theme' => nexus_env('TURNSTILE_THEME', 'auto'),
            'size' => nexus_env('TURNSTILE_SIZE', 'auto'),
        ],

        'google_recaptcha_v2' => [
            'class' => \App\Services\Captcha\Drivers\RecaptchaV2CaptchaDriver::class,
            'site_key' => nexus_env('RECAPTCHA_SITE_KEY'),
            'secret_key' => nexus_env('RECAPTCHA_SECRET_KEY'),
            'theme' => nexus_env('RECAPTCHA_THEME', 'light'),
            'size' => nexus_env('RECAPTCHA_SIZE', 'normal'),
        ],
    ],

    'attendance' => [
        'enabled' => nexus_env('CAPTCHA_ATTENDANCE_ENABLED', true),
    ],
];
