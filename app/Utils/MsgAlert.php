<?php
namespace App\Utils;

use Nexus\Database\NexusDB;

final class MsgAlert {

    private static ?self $instance = null;

    private static array $alerts = [];

    private string $redisKeyPrefix = "nexus_alerts";

    private function __construct()
    {
        $redis = NexusDB::redis();
        $result = $redis->lRange($this->getListKey(), 0, 10);
        if (!empty($result)) {
            $nowTimestamp = time();
            $valid = [];
            foreach ($result as $item) {
                $arr = json_decode($item, true);
                if (is_array($arr) && $arr['deadline'] > $nowTimestamp) {
                    $valid[$arr['name']] = $arr;
                } else {
                    $redis->lRem($this->getListKey(), $item, 0);
                }
            }
            self::$alerts = $valid;
        }
    }

    private function __clone()
    {

    }

    public static function getInstance(): MsgAlert
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }
        return self::$instance = new self;
    }



    public  function add(string $name, int $deadline, string $text, string $url = "", string $color = "red"): void
    {
        if (!isset(self::$alerts[$name])) {
            $params = compact('name', 'deadline', 'text', 'url', 'color');
            self::$alerts[$name] = $params;
            NexusDB::redis()->rPush($this->getListKey(), json_encode($params));
        }
    }

    private function getListKey(): string
    {
        return sprintf("%s:%s", $this->redisKeyPrefix, get_user_id());
    }


    public static function render(): void
    {
        $nowTimestamp = time();
        foreach (self::$alerts as $item) {
            if ($item['deadline'] > $nowTimestamp) {
                msgalert($item['url'] ?: '', $item['text'], $item['color'] ?: 'red');
            }
        }
    }

    public function remove($name): void
    {
        foreach (self::$alerts as $item) {
            if ($item['name'] == $name) {
                unset(self::$alerts[$name]);
                NexusDB::redis()->lRem($this->getListKey(), json_encode($item));
            }
        }
    }



}
