<?php

namespace App\Services\Captcha\Drivers;

use App\Services\Captcha\CaptchaDriverInterface;
use App\Services\Captcha\Exceptions\CaptchaValidationException;

class RecaptchaV2CaptchaDriver implements CaptchaDriverInterface
{
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function isEnabled(): bool
    {
        return !empty($this->config['site_key']) && !empty($this->config['secret_key']);
    }

    public function render(array $context = []): string
    {
        if (!$this->isEnabled()) {
            return '';
        }

        $labels = $context['labels'] ?? [];
        $label = $labels['image'] ?? $labels['code'] ?? 'Security Check';
        $theme = $this->config['theme'] ?? 'light';
        $size = $this->config['size'] ?? 'normal';
        $validSizes = ['compact', 'normal'];
        if (!in_array($size, $validSizes, true)) {
            $size = 'normal';
        }

        $attributes = sprintf(
            'class="g-recaptcha" data-sitekey="%s" data-theme="%s" data-size="%s"',
            htmlspecialchars($this->config['site_key'], ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($theme, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($size, ENT_QUOTES, 'UTF-8')
        );

        return sprintf(
            '<tr><td class="rowhead">%s</td><td align="left"><div %s></div>%s</td></tr>',
            htmlspecialchars($label, ENT_QUOTES, 'UTF-8'),
            $attributes,
            '<script src="https://www.recaptcha.net/recaptcha/api.js" async defer></script>'
        );
    }

    public function verify(array $payload, array $context = []): bool
    {
        $token = trim((string) ($payload['request']['g-recaptcha-response'] ?? ''));

        if ($token === '') {
            throw new CaptchaValidationException('Captcha verification token is missing.');
        }

        $secret = $this->config['secret_key'] ?? '';

        if ($secret === '') {
            throw new CaptchaValidationException('Captcha secret key is not configured.');
        }

        $data = [
            'secret' => $secret,
            'response' => $token,
        ];

        $remoteIp = $context['ip'] ?? null;

        if (!empty($remoteIp)) {
            $data['remoteip'] = $remoteIp;
        }

        $result = $this->sendVerificationRequest('https://www.recaptcha.net/recaptcha/api/siteverify', $data);

        if (!($result['success'] ?? false)) {
            throw new CaptchaValidationException('Captcha verification failed.');
        }

        return true;
    }

    protected function sendVerificationRequest(string $url, array $data): array
    {
        $payload = http_build_query($data);

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_SSL_VERIFYPEER => true,
            ]);

            $response = curl_exec($ch);

            if ($response === false) {
                $error = curl_error($ch);
                curl_close($ch);
                throw new CaptchaValidationException('Captcha verification request failed: ' . $error);
            }

            curl_close($ch);
        } else {
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'content' => $payload,
                    'timeout' => 10,
                ],
            ]);

            $response = file_get_contents($url, false, $context);

            if ($response === false) {
                throw new CaptchaValidationException('Captcha verification request failed.');
            }
        }

        $decoded = json_decode($response, true);

        if (!is_array($decoded)) {
            throw new CaptchaValidationException('Unexpected captcha verification response.');
        }

        return $decoded;
    }
}
