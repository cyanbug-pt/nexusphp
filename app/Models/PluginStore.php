<?php

namespace App\Models;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\HtmlString;
use Nexus\Database\NexusDB;
use Sushi\Sushi;
use Nexus\Plugin\Plugin;

class PluginStore extends Model
{
    use Sushi;

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    const PLUGIN_LIST_API = "https://nexusphp.org/plugin-store";
    const BLOG_POST_INFO_API = "https://nexusphp.org/wp-json/wp/v2/posts/%d";
    const BLOG_POST_URL = "https://nexusphp.org/?p=%d";

    private static array|null $rows =null;

    public function getRows()
    {
        $list = self::listAll(true);
        $enabled = Plugin::listEnabled();
//        dd($list, $enabled);
        foreach ($list as $key => $row) {
            $list[$key]['installed_version'] = $enabled[$row['plugin_id']] ?? '';
        }
        return $list;
    }

    protected function sushiShouldCache()
    {
        return false;
    }

    public function getBlogPostUrl(): string
    {
        return sprintf(self::BLOG_POST_URL, $this->post_id);
    }

    public function getFullDescription(): Htmlable
    {
        $url = $this->getBlogPostInfoUrl($this->post_id);
        $logPrefix = sprintf("post_id: %s, url: %s", $this->post_id, $url);
        $defaultContent = "Fail to get content ...";
        try {
            $result = Http::get($url)->json();
            do_log("$logPrefix, result: " . json_encode($result));
            $content =  $result['content']['rendered'] ?? $result['message'] ?? $defaultContent;
        } catch (\Exception $e) {
            do_log(sprintf(
                "%s, error: %s",
                $logPrefix, $e->getMessage() . $e->getTraceAsString()
            ), 'error');
            $content = $defaultContent;
        }
        return new HtmlString($content);
    }

    private function getBlogPostInfoUrl(int $postId): string
    {
        return sprintf(self::BLOG_POST_INFO_API, $postId);
    }

    public function hasNewVersion(): bool
    {
        $result = $this->installed_version
            && version_compare($this->version, $this->installed_version, '>');
        do_log(sprintf(
            "%s, installed_version: %s, version: %s, hasNew: %s",
            $this->plugin_id, $this->installed_version, $this->version, $result
        ));
        return $result;
    }

    public static function getInfo(string $id)
    {
        return Http::get(self::PLUGIN_LIST_API . "/plugin/$id")->json();
    }

    public static function listAll($withoutCache = false)
    {
        $log = "listAll, withoutCache: $withoutCache";
        $cacheKey = "nexus_plugin_store_all";
        $cacheTime = 86400;
        if (is_null(self::$rows)) {
            $log .= ", is_null";
            if ($withoutCache) {
                $log .= ", WITHOUT_CACHE";
                self::$rows = self::listAllFromRemote();
                NexusDB::cache_put($cacheKey, self::$rows, $cacheTime);
            } else {
                $log .= ", WITH_CACHE";
                self::$rows = NexusDB::remember($cacheKey, $cacheTime, function () {
                    return self::listAllFromRemote();
                });
            }
        } else {
            $log .= ", not_null";
        }
        do_log($log);
        return self::$rows;
    }

    private static function listAllFromRemote()
    {
        try {
            $response = Http::get(self::PLUGIN_LIST_API);
            if ($response->getStatusCode() != 200) {
                do_log(sprintf("status code: %d, body: %s", $response->getStatusCode(), $response->getBody()), 'error');
                return [];
            }
            $list = $response->json();
            foreach ($list as &$row) {
                foreach ($row as $key => $value) {
                    if (is_array($value)) {
                        $row[$key] = json_encode($value);
                    }
                }
            }
            return $list;
        } catch (\Exception $e) {
            do_log(sprintf("listAllFromRemote from: %s error: %s", self::PLUGIN_LIST_API, $e->getMessage()), 'error');
            return [];
        }
    }

    public static function getHasNewVersionCount(): int
    {
        if (!Gate::allows('viewAny', PluginStore::class)) {
            return 0;
        }
        $currentRouteName = Route::currentRouteName();
        $withoutCacheRouteName = ['filament.admin.resources.system.plugin-stores.index', 'filament.admin.pages.dashboard'];
        $list = self::listAll(in_array($currentRouteName, $withoutCacheRouteName));
        $enabled = Plugin::listEnabled();
        $count = 0;
        foreach ($list as $row) {
            $installedVersion = $enabled[$row['plugin_id']] ?? '';
            if ($installedVersion && version_compare($installedVersion, $row['version'], '<')) {
                $count++;
            }
        }
        return $count;
    }


}
