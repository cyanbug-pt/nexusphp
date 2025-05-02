<?php

namespace App\Http\Controllers;

use App\Models\PluginStore;
use App\Repositories\ToolRepository;
use App\Repositories\UploadRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Telegram\Bot\Api;
use Telegram\Bot\Commands\HelpCommand;

class ToolController extends Controller
{
    private $repository;

    public function __construct(ToolRepository $repository)
    {
        $this->repository = $repository;
    }

    public function notifications(): array
    {
        $user = Auth::user();
        $result = $this->repository->getNotificationCount($user);
        return $this->success($result);
    }


    public function test(Request $request)
    {
        $result = ['id' => 1];
        $result['logFile'] = getLogFile();
        $resource = new JsonResource($result);
        return $this->success($resource);
    }

    public function error(Request $request)
    {
        return view('error', ['error' => $request->query('error')]);
    }

}
