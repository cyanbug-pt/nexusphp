<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class CrowdinSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crowdin:sync
                            {action : Action to perform (upload|download)}
                            {--file= : Specific file to upload or download(affect pre translate)}
                            {--lang=* : Target languages to download (multiple values allowed, affect build + pre translate)}
                            {--runEnv= : laravel or nexus}
                            {--mtType= : Machine translation type}
                            {--noPreTrans= : Whether do pre translation when action = download}
                            {--debug= : If true, will not copy translation file when action = download}';

    const RUN_ENV_NEXUS = 'nexus';
    const RUN_ENV_LARAVEL = 'laravel';

    protected string $runEnv = self::RUN_ENV_LARAVEL;

    protected string $mtType = "crowdin";
    protected array|null $mtInfo = null;

    protected bool $noPreTrans = true;
    protected bool $debug = false;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync translations with Crowdin using API v2';

    /**
     * Crowdin API base URL
     *
     * @var string
     */
    protected $apiBaseUrl = 'https://api.crowdin.com/api/v2';

    /**
     * Project ID
     *
     * @var int
     */
    protected $projectId;

    /**
     * API Token
     *
     * @var string
     */
    protected $token;

    /**
     * Source files directory
     *
     * @var string
     */
    protected $sourceDir;

    /**
     * Target translations directory
     *
     * @var string
     */
    protected $translationsDir;

    protected array $languages;

    /**
     * laravel-lang to crowdin map
     * some is not the same
     * --lang option use laravel-lang style
     *
     * @var array|string[]
     */
    protected array $customMap = [
        'pt' => 'pt-PT',
        'es' => 'es-ES',
        'sv' => 'sv-SE',
        'nb' => 'no',//挪威
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->projectId = config('services.crowdin.project_id');
        $this->token = config('services.crowdin.access_token');

        if (empty($this->projectId) || empty($this->token)) {
            $this->error('Crowdin project ID and token are required.');
            return 1;
        }

        $action = $this->argument('action');
        $runEnv = $this->option('runEnv');
        $mtType = $this->option('mtType');
        $noPreTrans = $this->option('noPreTrans');
        $debug = $this->option('debug');
        if ($runEnv) {
            $this->runEnv = $runEnv;
        }
        if ($this->runEnv === self::RUN_ENV_NEXUS) {
            $this->sourceDir = $this->translationsDir = base_path('lang');
        } else {
            $this->sourceDir = $this->translationsDir = base_path('resources/lang');
        }
        if ($mtType) {
            $this->mtType = $mtType;
        }
        if (!is_null($noPreTrans)) {
            $this->noPreTrans = (bool) $noPreTrans;
        }
        if (!is_null($debug)) {
            $this->debug = (bool)$debug;
        }
        $this->info(
            "action: $action,
            runEnv: $this->runEnv,
            mtType: $this->mtType,
            noPreTrans: $this->noPreTrans,
            sourceDir: $this->sourceDir
            ");

        switch ($action) {
            case 'upload':
                $this->uploadSourceFiles();
                break;
            case 'download':
                $this->downloadTranslations();
                break;
            default:
                $this->error("Invalid action. Use 'upload' or 'download'.");
                return 1;
        }

        return 0;
    }

    /**
     * Upload source files to Crowdin
     */
    protected function uploadSourceFiles()
    {
        $this->info('Uploading source files to Crowdin...');

        $specificFile = $this->getFileName();

        if ($specificFile) {
            // Upload specific file only
            $filePath = $this->sourceDir . '/en/' . $specificFile;

            if (!File::exists($filePath)) {
               throw new \RuntimeException("file '$specificFile' does not exists.");
            }

            $this->info("Uploading specific file: {$specificFile}");
            $this->uploadFile($filePath, $specificFile);
            $this->info("File {$specificFile} uploaded successfully.");
        } else {
            throw new \RuntimeException("please specify a file to upload");
            // Upload all files in the source directory
            $files = File::allFiles($this->sourceDir);

            $bar = $this->output->createProgressBar(count($files));
            $bar->start();

            foreach ($files as $file) {
                $relativePath = $file->getRelativePathname();
                $this->uploadFile($file->getRealPath(), $relativePath);
                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
            $this->info('Source files uploaded successfully.');
        }
    }

    /**
     * Upload a single file to Crowdin
     */
    protected function uploadFile($filePath, $relativePath)
    {
        $directoryId = $this->getDirectoryId();
        // First, check if the file exists in the project
        $response = $this->getHttpClient()->get(
            $this->getProjectApiEndpoint("files?directoryId=$directoryId&filter=$relativePath")
        );

        $files = $response->json('data');

        $fileExists = false;
        $fileId = null;

        foreach ($files as $file) {
            if ($file['data']['name'] === $relativePath) {
                $fileExists = true;
                $fileId = $file['data']['id'];
                break;
            }
        }

        // Add new file
        $storageId = $this->uploadToStorage($filePath);
        if (!$storageId) {
            throw new \RuntimeException("Failed to upload {$filePath} to storage");
        }

        if ($fileExists) {
            // Update existing file
            $response = $this->getHttpClient()->put($this->getProjectApiEndpoint("files/$fileId"), [
                'storageId' => $storageId
            ]);
        } else {
            $response = $this->getHttpClient()->post($this->getProjectApiEndpoint("files"), [
                'storageId' => $storageId,
                'name' => basename($relativePath),
                'directoryId' => $directoryId,
            ]);
        }

        $this->info("filePath: $filePath, relativePath: $relativePath, fileExists: $fileExists");

        if (!$response->successful()) {
            throw new \RuntimeException("Failed to process {$relativePath}: " . $response->body());
        }
    }

    /**
     * Upload file to Crowdin storage
     */
    protected function uploadToStorage($filePath)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->token}",
            'Crowdin-API-FileName' => basename($filePath),
        ])->withBody(
            file_get_contents($filePath), 'application/octet-stream'
        )->post("{$this->apiBaseUrl}/storages");

        if ($response->successful()) {
            return $response->json('data.id');
        }

        return null;
    }

    /**
     * Download translations from Crowdin
     */
    protected function downloadTranslations()
    {
        $fileName = $this->getFileName();
        $logMsg = "fileName: {$fileName}";
        $this->info("$logMsg, Downloading translations from Crowdin...");
        $fileIds = $this->listFileIds($fileName);
        if (!$fileIds) {
            throw new \RuntimeException("Can't get fileId of file {$fileName}");
        }
        $languages = $this->languages = $this->getLanguages();

        //do machine translate first
        if (!$this->noPreTrans) {
            $preTransId = $this->doMachineTranslate($fileIds, $languages);
            $this->wait(function () use ($preTransId) {
                $response = $this->getHttpClient()->get($this->getProjectApiEndpoint("pre-translations/{$preTransId}"));
                if (!$response->successful()) {
                    throw new \RuntimeException("Failed to check pre-translations status");
                }
                $status = $response->json("data.status");
                $this->info("Pre translations status: $status");
                return $status == "finished";
            });

            $this->info("Pre translations done ...");
        } else {
            $this->info("No pre translations ...");
        }

        // build the directory
        $directoryId = $this->getDirectoryId();
        $buildUrl = $this->getProjectApiEndpoint("translations/builds/directories/$directoryId");
        $response = $this->getHttpClient()->post($buildUrl, ['targetLanguageIds' => $languages]);

        if (!$response->successful()) {
            $this->error('Failed to build: ' . $response->body());
            return;
        }

        $buildId = $response->json('data.id');
        $this->info("Translation build started with ID: {$buildId}");

        // Wait for the build to complete
        $this->info('Waiting for build to complete...');
        $buildUrl = "{$this->apiBaseUrl}/projects/{$this->projectId}/translations/builds/{$buildId}";

        $this->wait(function () use ($buildUrl) {
            $response = $this->getHttpClient()->get($buildUrl);
            if (!$response->successful()) {
                throw new \RuntimeException("Failed to check build status of {$buildUrl}");
            }
            $status = $response->json("data.status");
            $this->info("Build status: $status");
            return $status == "finished";
        });
        $this->info("Translation build done ...");

        // Download the build
        $response = $this->getHttpClient()->get("{$buildUrl}/download");

        if (!$response->successful()) {
            $this->error('Failed to get download URL: ' . $response->body());
            return;
        }

        $downloadUrl = $response->json('data.url');
        $this->info("Downloading from: {$downloadUrl}");

        // Download the ZIP file
        $zipContent = file_get_contents($downloadUrl);
        $zipPath = storage_path("app/crowdin_translations_$buildId.zip");
        file_put_contents($zipPath, $zipContent);

        $this->info("zipPath: {$zipPath}");
        // Extract ZIP to temporary directory
        $extractPath = storage_path("app/crowdin_translations_$buildId.extract");

        // Clean up existing extract path if it exists
        if (File::exists($extractPath)) {
            File::deleteDirectory($extractPath);
        }

        File::makeDirectory($extractPath, 0755, true);

        $zip = new \ZipArchive();
        if ($zip->open($zipPath) === true) {
            $zip->extractTo($extractPath);
            $zip->close();

            // Move translations to the proper directories
            $this->moveTranslations($extractPath);

            // Clean up
//            File::deleteDirectory($extractPath);
//            File::delete($zipPath);

            $this->info('Translations downloaded and processed successfully.');
        } else {
            $this->error('Failed to extract the ZIP file.');
        }
    }

    /**
     * Get all project languages
     */
    protected function getAllProjectLanguages()
    {
        $this->info('Fetching all project languages...');

        $response = $this->getHttpClient()->get($this->getProjectApiEndpoint());

        if (!$response->successful()) {
            $this->error('Failed to fetch project languages: ' . $response->body());
            return [];
        }
        $languageIds = $response->json('data.targetLanguageIds');
        if (empty($languageIds)) {
            throw new \RuntimeException('No project languages found.');
        }

        $engineInfo = $this->getMachineTranslationEngine();
        $engineSupportedLanguageIds = $engineInfo['supportedLanguageIds'];
        $result = array_intersect($languageIds, $engineSupportedLanguageIds);

        $this->info(sprintf(
            "Found %s project languages: %s \nengine supported %s languages: %s \nresult: %s languages: %s",
            count($languageIds), implode(', ', $languageIds),
            count($engineSupportedLanguageIds), implode(', ', $engineSupportedLanguageIds),
            count($result), implode(', ', $result)
        ));

        return $result;
    }

    /**
     * Get file ID by filename, if filename is empty, get all files
     */
    protected function listFileIds($fileName): array
    {
        $directoryId = $this->getDirectoryId();
        $url = $this->getProjectApiEndpoint("files?directoryId=$directoryId&limit=500");
        if ($fileName) {
            $url .= "&filter={$fileName}";
        }
        $response = $this->getHttpClient()->get($url);
        if (!$response->successful()) {
            throw new \RuntimeException('[getFileId] Failed to fetch project files: ' . $response->body());
        }
//        $this->info("[getFileId] FileName: {$fileName} response: {$response->body()}");
        $result = [];
        foreach ($response->json('data') as $file) {
            if ($fileName) {
                if ($file['data']['name'] === $fileName) {
                    $result[] = $file['data']['id'];
                }
            } else {
                $result[] = $file['data']['id'];
            }
        }
        if (empty($result)) {
            throw new \RuntimeException('No project files found for name: ' . $fileName);
        }
        $this->info("[listFileIds] by name: $fileName, got fileIdCount: " . count($result));
        return $result;
    }

    /**
     * Move translations from extracted ZIP to the proper directories
     */
    protected function moveTranslations($extractPath)
    {

        $this->info('Moving translations to the proper directories: ' . $this->translationsDir);

        $directories = File::directories($extractPath);

        foreach ($directories as $directory) {
            $langCode = basename($directory);
            if (!in_array($langCode, $this->languages)) {
                $this->warn("skip extra to lang code: {$langCode} due to not in specified language code.");
                continue;
            }
            $customMap = array_flip($this->customMap);
            if (isset($customMap[$langCode])) {
                $langCode = $customMap[$langCode];
            }
            //use underline
            $targetDir = "{$this->translationsDir}/" . str_replace("-", "_", $langCode);
            $this->info("Moving translations to {$targetDir}");

            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }

            // Copy all files
            $files = File::allFiles($directory);
            $basePathLength = strlen(base_path());
            foreach ($files as $file) {
                $relativePath = $file->getRelativePathname();
                $targetPath = "{$targetDir}/{$relativePath}";

                // Create nested directories if needed
                $targetDirName = dirname($targetPath);
                if (!File::exists($targetDirName)) {
                    File::makeDirectory($targetDirName, 0755, true);
                }
                $this->info(sprintf(
                    "Moving translations %s => %s",
                    substr($file->getRealPath(), $basePathLength),
                    substr($targetPath, $basePathLength)
                ));
                if (!$this->debug) {
                    File::copy($file->getRealPath(), $targetPath);
                }
            }

            $this->info("Processed translations for language: {$langCode}");
        }
    }

    protected function getDirectoryId()
    {
        $url = $this->getProjectApiEndpoint("directories?filter=$this->runEnv");
        $response = $this->getHttpClient()->get($url);
        $data = $response->json('data');
        if (empty($data)) {
            throw new \RuntimeException("can not get directory of runEnv: $this->runEnv, responseBody: " . $response->body());
        }
        if (count($data) !== 1) {
            throw new \RuntimeException("multiple directory found of runEnv: $this->runEnv, responseBody: " . $response->body());
        }
        return $data[0]['data']['id'];
    }

    protected function getHttpClient(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withToken($this->token);
    }

    protected function getProjectApiEndpoint($path = ""): string
    {
        $result = sprintf(
            "%s/projects/%s",
            trim($this->apiBaseUrl, '/'),
            $this->projectId
        );
        if (!empty($path)) {
            $result .= "/" . trim($path, '/');
        }
        return $result;
    }

    protected function doMachineTranslate($fileIds, $languages)
    {
        $engineInfo = $this->getMachineTranslationEngine();
        $params = [
            'languageIds' => $languages,
            'fileIds' => $fileIds,
            'method' => 'mt',
            'engineId' => $engineInfo['id'],
        ];
        $response = $this->getHttpClient()->post($this->getProjectApiEndpoint("pre-translations"), $params);
        if (!$response->successful()) {
            throw new \RuntimeException('Failed to post pre-translations: ' . $response->body());
        }
        $this->info("Pre translations file: ".json_encode($fileIds)." to language: ".json_encode($languages)." successfully");
        return $response->json('data.identifier');
    }

    protected function getMachineTranslationEngine()
    {
        if (!is_null($this->mtInfo)) {
            return $this->mtInfo;
        }
        $url = sprintf("%s/mts", trim($this->apiBaseUrl, '/'));
        $response = $this->getHttpClient()->get($url);
        $data = $response->json('data');
        foreach ($data as $mt) {
            if ($mt['data']['type'] === $this->mtType) {
                return $this->mtInfo = $mt['data'];
            }
        }
        throw new \RuntimeException("can not get machine-translation id for mtType: $this->mtType, data: " . json_encode($data));
    }

    protected function wait(callable $callback)
    {
        $maxAttempts = 60;
        $attempt = 0;
        $isDone = false;
        while (!$isDone && $attempt < $maxAttempts) {
            sleep(1);
            $attempt++;
            $this->info("attempt #{$attempt} of {$maxAttempts}");
            $isDone = $callback();
        }
        if (!$isDone) {
            throw new \RuntimeException('Failed to wait for done.');
        }
    }

    protected function getFileName()
    {
        $fileName = $this->option('file');
        if ($fileName && !str_ends_with($fileName, '.php')) {
            $fileName .= '.php';
        }
        return $fileName;
    }

    protected function getLanguages()
    {
        $languages = $this->option('lang');

        // If no languages specified, get all project languages
        if (empty($languages) || in_array($languages, ['all', '*'])) {
            return $this->getAllProjectLanguages();
        }
        $result = [];
        foreach ($languages as $language) {
            if (empty(trim($language))) {
                continue;
            }
            if (isset($this->customMap[$language])) {
                $language = $this->customMap[$language];
            }
            //crowdin use -
            $result[] = str_replace('_', '-', $language);
        }
        return $result;
    }

}
