<?php
namespace Nexus\Attachment;

use Nexus\Attachment\Drivers\Chevereto;
use Nexus\Attachment\Drivers\Local;
use Nexus\Attachment\Drivers\Lsky;

abstract class Storage {

    private static array $drivers = [];

    const DRIVER_LOCAL = 'local';
    const DRIVER_CHEVERETO = 'chevereto';
    const DRIVER_LSKY = 'lsky';

    /**
     * upload to remote and return full url
     *
     * @param string $filepath
     * @return string
     */
    abstract function upload(string $filepath): string;
    abstract function getBaseUrl(): string;
    abstract function getDriverName(): string;

    public function uploadGetLocation(string $filepath): string
    {
        $url = $this->upload($filepath);
        return $this->trimBaseUrl($url);
    }

    public function getImageUrl(string $location): string
    {
        return sprintf('%s/%s', trim($this->getBaseUrl(), '/'), trim($location, '/'));
    }

    protected function trimBaseUrl(string $url): string
    {
        $baseUrl = trim($this->getBaseUrl(), '/') . "/";
        if (str_starts_with($url, $baseUrl)) {
            return substr($url, strlen($baseUrl));
        }
        return $url;
    }

    public static function getDriver(string $name = null): Storage
    {
        $driver = $name ?: get_setting("image_hosting.driver");
        if (isset(self::$drivers[$driver])) {
            return self::$drivers[$driver];
        }
        $result = null;
        if ($driver == self::DRIVER_CHEVERETO) {
            $result = new Chevereto();
        } else if ($driver == self::DRIVER_LSKY) {
            $result = new Lsky();
        } else if ($driver == self::DRIVER_LOCAL) {
            $result = new Local();
        }
        if ($result) {
            return self::$drivers[$driver] = $result;
        }
        throw new \Exception("Unsupported driver: $driver");
    }
}
