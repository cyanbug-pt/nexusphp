<?php

namespace App\Models;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;
use Sushi\Sushi;

class PluginStore extends Model
{
    use Sushi;

    const PLUGIN_LIST_API = "https://nppl.nexusphp.workers.dev";
    const BLOG_POST_INFO_API = "https://nexusphp.org/wp-json/wp/v2/posts/%d";
    const BLOG_POST_URL = "https://nexusphp.org/?p=%d";

    public function getRows()
    {
        return Http::get(self::PLUGIN_LIST_API)->json();
    }

    public function getBlogPostUrl(): string
    {
        return sprintf(self::BLOG_POST_URL, $this->post_id);
    }

    public function getFullDescription(): Htmlable
    {
        $url = $this->getBlogPostInfoUrl($this->post_id);
        $logPrefix = sprintf("post_id: %s, url: %s", $this->post_id, $url);
        $defaultContent = "无法获取详细信息 ...";
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

    public static function getInfo(string $id)
    {
        return Http::get(self::PLUGIN_LIST_API . "/plugin/$id")->json();
    }
}
