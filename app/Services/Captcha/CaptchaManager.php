<?php

namespace App\Services\Captcha;

use App\Services\Captcha\Exceptions\CaptchaValidationException;
use App\Models\Setting;
use Illuminate\Support\Arr;

class CaptchaManager
{
    /** @var array<string, CaptchaDriverInterface> */
    protected array $drivers = [];

    protected ?array $config = null;

    public function driver(?string $name = null): CaptchaDriverInterface
    {
        $name = $name ?? $this->getDefaultDriver();

        $driver = $this->getDriverInstance($name);

        if ($name !== 'image' && !$driver->isEnabled()) {
            return $this->driver('image');
        }

        return $driver;
    }

    public function render(array $context = []): string
    {
        return $this->driver()->render($context);
    }

    public function verify(array $payload, array $context = []): bool
    {
        try {
            return $this->driver()->verify($payload, $context);
        } catch (CaptchaValidationException $exception) {
            throw $exception;
        }
    }

    public function isEnabled(): bool
    {
        return $this->driver()->isEnabled();
    }

    protected function getDriverInstance(string $name): CaptchaDriverInterface
    {
        if (!isset($this->drivers[$name])) {
            try {
                $this->drivers[$name] = $this->resolveDriver($name);
            } catch (\InvalidArgumentException $exception) {
                if ($name !== 'image') {
                    return $this->getDriverInstance('image');
                }
                throw $exception;
            }
        }

        return $this->drivers[$name];
    }

    protected function resolveDriver(string $name): CaptchaDriverInterface
    {
        $config = $this->getConfigValue("drivers.$name", []);

        if (!is_array($config) || empty($config)) {
            throw new \InvalidArgumentException("Captcha driver [$name] is not defined.");
        }

        $driverClass = Arr::get($config, 'class');

        if (!$driverClass || !class_exists($driverClass)) {
            throw new \InvalidArgumentException("Captcha driver class for [$name] is invalid.");
        }

        $driver = new $driverClass($config);

        if (!$driver instanceof CaptchaDriverInterface) {
            throw new \InvalidArgumentException("Captcha driver [$name] must implement " . CaptchaDriverInterface::class);
        }

        return $driver;
    }

    protected function getDefaultDriver(): string
    {
        return (string) $this->getConfigValue('default', 'image');
    }

    protected function getConfigValue(string $key, $default = null)
    {
        if ($this->config === null) {
            $config = null;
            if (function_exists('app')) {
                try {
                    $repository = app('config');
                    if ($repository) {
                        $config = $repository->get('captcha');
                    }
                } catch (\Throwable $exception) {
                    $config = null;
                }
            }

            if (!is_array($config) && function_exists('nexus_config')) {
                $config = nexus_config('captcha', []);
            }

            if (!is_array($config)) {
                $path = (defined('ROOT_PATH') ? ROOT_PATH : dirname(__DIR__, 3) . DIRECTORY_SEPARATOR) . 'config/captcha.php';
                $config = is_file($path) ? require $path : [];
            }

            $this->config = is_array($config) ? $config : [];

            try {
                $settings = Setting::get('captcha', []);
                if (is_array($settings) && !empty($settings)) {
                    $this->config = array_replace_recursive($this->config, $settings);
                }
            } catch (\Throwable $exception) {
                // ignore database errors at bootstrap phase
            }
        }

        return Arr::get($this->config, $key, $default);
    }
}
