<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateLang extends Command
{
    protected $signature = 'lang:translate {source} {target}
                            {filename? : Optional file to translate (php file or json)}
                            {--dry-run : Only print translations without writing files}
                            {--ignore= : Comma-separated keys to ignore (e.g. key1,key2)}
                            {--json : Also translate JSON language files}';

    protected $description = 'Translate Laravel language files (PHP or JSON) using Google Translate';

    protected $tr;
    protected $ignoreKeys = [];
    protected $cache = [];
    protected $cachePath;

    public function handle()
    {
        $source = $this->argument('source');
        $target = $this->argument('target');
        $filename = $this->argument('filename');
        $this->ignoreKeys = array_filter(explode(',', $this->option('ignore')));
        $this->cachePath = storage_path("framework/lang-translate-cache.{$source}.{$target}.json");

        $this->loadCache();

        $this->tr = new GoogleTranslate();
        $this->tr->setSource($source);
        $this->tr->setTarget($target);

        $langPath = resource_path('lang');

        //谷歌使用的是 -， 本地使用 _
        $source = str_replace("-", "_", $source);
        $target = str_replace("-", "_", $target);

        $dir = "{$langPath}/{$source}";
        if ($filename) {
            // 👇 指定具体文件翻译
            $this->translateSpecificFile($filename, $source, $target);
        } else {
            // 👇 未指定时，用户确认是否翻译所有文件
            $answer = $this->ask("你没有指定文件名，是否翻译目录 $dir 下所有语言文件？请输入 yes 确认");
            if (strtolower($answer) === 'yes') {
                foreach (File::files("{$langPath}/{$source}") as $file) {
                    if ($file->getExtension() === 'php') {
                        $this->translatePhpFile($file->getPathname(), $source, $target);
                    }
                }
                if ($this->option('json')) {
                    $jsonFile = "{$langPath}/{$source}.json";
                    if (file_exists($jsonFile)) {
                        $this->translateJsonFile($jsonFile, $source, $target);
                    }
                }
            } else {
                // 👇 用户的输入被当作 filename 处理
                $this->translateSpecificFile($answer, $source, $target);
            }
        }

        $this->saveCache();

        $this->info("🎉 $source => $target Done !");
        return 0;
    }

    protected function translatePhpFile($sourceFile, $sourceLang, $targetLang)
    {
        $relativePath = basename($sourceFile);
        $targetFile = resource_path("lang/{$targetLang}/{$relativePath}");

        $data = require $sourceFile;
        $translated = $this->translateArray($data);

        $export = var_export($translated, true);
        if ($this->option('dry-run')) {
            $this->line("🔍 Would write to: $targetFile\n$export\n");
        } else {
            if (!file_exists(dirname($targetFile))) {
                mkdir(dirname($targetFile), 0755, true);
            }
            file_put_contents($targetFile, "<?php\n\nreturn $export;\n");
            $this->info("✅ Wrote translated file: $targetFile");
        }
    }

    protected function translateJsonFile($jsonFile, $sourceLang, $targetLang)
    {
        $targetFile = resource_path("lang/{$targetLang}.json");
        $content = json_decode(file_get_contents($jsonFile), true);
        $translated = [];

        foreach ($content as $key => $value) {
            if (in_array($key, $this->ignoreKeys)) {
                $translated[$key] = $value;
                continue;
            }

            $translated[$key] = $this->translateText($value);
        }

        $pretty = $this->json_encode_pretty($translated);

        if ($this->option('dry-run')) {
            $this->line("🔍 Would write to: $targetFile\n$pretty\n");
        } else {
            file_put_contents($targetFile, $pretty);
            $this->info("✅ Wrote translated JSON: $targetFile");
        }
    }

    protected function translateArray(array $data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $this->ignoreKeys)) {
                $result[$key] = $value;
                continue;
            }

            if (is_array($value)) {
                $result[$key] = $this->translateArray($value);
            } else {
                $result[$key] = $this->translateText($value);
            }
        }
        return $result;
    }

    protected function translateText(string $text): string
    {
        if (isset($this->cache[$text])) {
            $this->line("⚡️ Cached: $text => {$this->cache[$text]}");
            return $this->cache[$text];
        }

        try {
            $translated = $this->tr->translate($text);
            $this->cache[$text] = $translated;
            $this->line("🌍 $text => $translated");
            return $translated;
        } catch (\Exception $e) {
            $this->warn("❌ Failed to translate: $text");
            return $text;
        }
    }

    protected function translateSpecificFile($filename, $source, $target)
    {
        $langPath = resource_path("lang");

        if (str_ends_with($filename, '.json')) {
            $jsonPath = "{$langPath}/{$filename}";
            if (!file_exists($jsonPath)) {
                $jsonPath = "{$langPath}/{$source}.json";
            }
            if (file_exists($jsonPath)) {
                $this->translateJsonFile($jsonPath, $source, $target);
            } else {
                $this->error("❌ JSON 文件未找到：$filename");
            }
        } else {
            $phpPath = "{$langPath}/{$source}/$filename";
            if (!str_ends_with($filename, '.php')) {
                $phpPath .= '.php';
            }
            if (file_exists($phpPath)) {
                $this->translatePhpFile($phpPath, $source, $target);
            } else {
                $this->error("❌ PHP 语言文件未找到：$filename");
            }
        }
    }

    protected function loadCache()
    {
        if (file_exists($this->cachePath)) {
            $this->cache = json_decode(file_get_contents($this->cachePath), true);
        }
    }

    protected function saveCache()
    {
        if (!$this->option('dry-run')) {
            file_put_contents($this->cachePath, json_encode($this->cache, JSON_UNESCAPED_UNICODE));
        }
    }

    protected function json_encode_pretty($data, int $indentSize = 4): string
    {
        // 默认格式化（PHP 默认是 2 空格）
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // 自定义缩进
        $indentChar = str_repeat(' ', $indentSize);

        // 将默认的 2 空格缩进替换为自定义缩进
        $formatted = preg_replace_callback('/^( +)/m', function ($matches) use ($indentChar) {
            $level = strlen($matches[1]) / 2;
            return str_repeat($indentChar, (int)$level);
        }, $json);

        return $formatted;
    }

}
