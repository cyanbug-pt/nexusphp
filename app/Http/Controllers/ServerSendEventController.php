<?php

namespace App\Http\Controllers;

use App\Models\PluginStore;
use App\Repositories\ToolRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ServerSendEventController extends Controller
{
    public function sse(Request $request)
    {
        $this->initSSE();
        $response = response()->stream(function () use ($request) {
            $action = $request->input('action');
            $this->sendData("action: $action");
            try {
                if ($action == "install_plugin") {
                    $this->checkComposer();
                    $pluginId = $request->input('plugin_id');
                    $this->sendData("pluginId: $pluginId");
                    $this->doActionInstallPlugin($pluginId);
                } else {
                    throw new \InvalidArgumentException("Invalid action: $action");
                }
            }catch (\Throwable $throwable) {
                $this->sendData("error: " . $throwable->getMessage());
                $this->sendData("close");
            }
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');
        $response->headers->set('X-Accel-Buffering', 'no');

        return $response;
    }

    private function initSSE(): void
    {
        @set_time_limit(0); // Disable time limit

        // Prevent buffering
        if(function_exists('apache_setenv')){
            @apache_setenv('no-gzip', 1);
        }

        @ini_set('zlib.output_compression', 0);
        @ini_set('implicit_flush', 1);

        while (ob_get_level() != 0) {
            ob_end_flush();
        }
        ob_implicit_flush(1);
    }

    private function sendData(string $data): void
    {
        echo sprintf("data: %s\n\n", $data);
        @ob_flush();
        @flush();
    }

    private function runCommand(string $command): void
    {
        $this->sendData("running $command, this may take a while...");
        $process = Process::fromShellCommandline($command);
        $process->setWorkingDirectory(base_path());
        $process->setTimeout(null);
        $process->mustRun(function ($type, $buffer) {
            $this->sendData($buffer);
        });
    }

    private function doActionInstallPlugin(string $pluginId): void
    {
        $pluginInfo = PluginStore::getInfo($pluginId);
        if (!$pluginInfo) {
            throw new \InvalidArgumentException("invalid plugin: $pluginId");
        }
        $this->sendData(sprintf("going to install plugin: %s, version: %s", $pluginInfo['title'], $pluginInfo['version']));
        $commands = [];
        $commands[] = sprintf("composer config repositories.%s git %s", $pluginInfo['plugin_id'], $pluginInfo['remote_url']);
        $commands[] = sprintf("composer require %s:%s", $pluginInfo['package_name'], $pluginInfo['version']);
        $commands[] = sprintf("php artisan plugin install %s", $pluginInfo['package_name']);
        foreach ($commands as $command) {
            $this->runCommand($command);
        }
    }

    private function checkComposer(): void
    {
        $this->sendData("checking composer ...");
        $composerCacheDir = executeCommand("composer config cache-vcs-dir -f " . base_path("composer.json"));
        $this->sendData("composer cache-vcs-dir: $composerCacheDir");
        if (!is_dir($composerCacheDir)) {
            $this->sendData("going to mkdir: $composerCacheDir");
            try {
                mkdir($composerCacheDir, 0755, true);
                $this->sendData("success create composer cache-vcs-dir: $composerCacheDir");
            } catch (\Throwable $e) {
                $this->sendData("fail to mkdir: " . $e->getMessage());
                $this->sendData("Please execute the following command as root user:");
                $this->sendData(sprintf("mkdir -p %s", $composerCacheDir));
                throw new \RuntimeException("stop due to composer cache-vcs-dir: $composerCacheDir not exists");
            }
        }
        if (!is_writable($composerCacheDir)) {
            $this->sendData("cache directory: $composerCacheDir is not writable");
            $this->sendData("Please execute the following command as root user:");
            $user = executeCommand("whoami");
            $this->sendData(sprintf("chown -R %s:%s %s", $user, $user, $composerCacheDir));
            throw new \RuntimeException("stop due to composer cache-vcs-dir: $composerCacheDir not writable");
        }
    }

}
