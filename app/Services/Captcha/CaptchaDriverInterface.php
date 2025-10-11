<?php

namespace App\Services\Captcha;

interface CaptchaDriverInterface
{
    public function isEnabled(): bool;

    /**
     * Render the captcha markup for HTML forms.
     */
    public function render(array $context = []): string;

    /**
     * Verify the captcha response.
     */
    public function verify(array $payload, array $context = []): bool;
}

