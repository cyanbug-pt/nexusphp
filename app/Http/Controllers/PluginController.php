<?php

namespace App\Http\Controllers;

use App\Repositories\PluginRepository;
use App\Repositories\ToolRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Telegram\Bot\Api;
use Telegram\Bot\Commands\HelpCommand;

class PluginController extends Controller
{
    private $repository;

    public function __construct(PluginRepository $repository)
    {
        $this->repository = $repository;
    }


    public function runCommandSSE(Request $request)
    {
        $commands = [
            ['pwd'], // Example command 1
            ['ls', '-la'], // Example command 2
            ['composer', '--version'], // Example command 3
            ['composer', 'why', 'ext-zip']
        ];
        foreach ($commands as $command) {
            $process = new Process($command);
            $process->setTimeout(0); // Set timeout for each process

            try {
                $process->mustRun(function ($type, $buffer) {
                    if (Process::OUT === $type) {
                        echo "Output: " . $buffer; // 实时输出
                    } else { // Process::ERR === $type
                        echo "Error: " . $buffer;
                    }
                });
            } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
                echo "Command failed: " . implode(' ', $command) . "\n";
                echo $e->getMessage();
                break; // Stop executing further commands
            }
        }

    }

}
