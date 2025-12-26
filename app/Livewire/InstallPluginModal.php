<?php

namespace App\Livewire;

use App\Models\PluginStore;
use Livewire\Component;
use Symfony\Component\Process\Process;

class InstallPluginModal extends Component
{
//    public PluginStore $record;

    public $output = ''; // 存储命令输出

//    public function mount(PluginStore $record)
//    {
//        $this->recored = $record;
//        $this->output = sprintf("点击按钮以开始安装 %s ...", $record->title);
//    }

    public function executeCommand($command)
    {
        $this->output = ''; // 清空之前的输出
//        $command = "whereis composer";
//        $process = new Process([$command]);
//        $process->setTimeout(60); // 设置超时时间（秒）
//
//        $process->start(); // 启动异步进程
//
//        foreach ($process as $type => $data) {
//            if ($type === Process::OUT) {
//                $this->output .= $data; // 实时追加标准输出
//            } elseif ($type === Process::ERR) {
//                $this->output .= "[ERROR]: $data"; // 实时追加错误输出
//            }
//
////            $this->dispatch('updateTextarea', $this->output); // 通知前端更新
//        }
        $process = new Process(['/usr/local/bin/composer', 'info']);
        $process->setTimeout(3600); // 可选，设置超时时间
        $basePath = base_path();
        do_log("base path: $basePath");
        $process->setWorkingDirectory($basePath);
        try {
            $process->mustRun(function ($type, $buffer) {
                if (Process::OUT === $type) {
                    $this->output = $buffer;
                    $this->dispatch('updateTextarea', $this->output);
                } else { // Process::ERR === $type
                    do_log("executeCommand, ERR: " . $buffer, 'error');
                }
            });
        } catch (\Exception $e) {
            do_log($e->getMessage(), 'error');
        }
    }

    public function render()
    {
        return view('livewire.install-plugin-modal');
    }
}
