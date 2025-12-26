<?php

namespace App\Http\Controllers;

use App\Exceptions\InsufficientPermissionException;
use App\Models\Setting;
use App\Utils\ApiQueryBuilder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected ?array $extraFields = null;
    protected ?array $extraSettingNames = null;

    /**
     * 返回成功信息
     *
     * @param $data
     * @param $msg
     * @return array
     */
    public function success($data, $msg = null): array
    {
        if (is_null($msg)) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
            $caller = $backtrace[1];
            $msg = $this->getReturnMsg($caller);
        }
        return success($msg, $data);
    }

    /**
     * 返回成功信息，对于不是 JsonResource 的数据，进行包装。返回的数据在 data.data 中
     *
     * @deprecated 没有必要，已经在 api() 中添加 data 包裹，使用 success() 即可
     * @param $data
     * @param $msg
     * @return array
     */
    public function successJsonResource($data, $msg = null): array
    {
        if (is_null($msg)) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
            $caller = $backtrace[1];
            $msg = $this->getReturnMsg($caller);
        }
        if ($data instanceof JsonResource) {
            return $this->success($data, $msg);
        }
        $resource = new JsonResource($data);
        return $this->success($resource, $msg);
    }

    /**
     * 返回失败信息，目前对于失败信息不需要包装
     *
     * @param $data
     * @param $msg
     * @return array
     */
    public function fail($data, $msg = null)
    {
        if (is_null($msg)) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
            $caller = $backtrace[1];
            $msg = $this->getReturnMsg($caller);
        }
        return fail($msg, $data);
    }

    protected function getReturnMsg(array $backtrace)
    {
        $title = $this->title ?? '';
        if (empty($title)) {
            $title = $backtrace['class'];
            $pos = strripos($title, '\\');
            $title = substr($title, $pos + 1);
            $title = str_replace('Controller', '', $title);
        }
        $action = $backtrace['function'];
        $map = [
            'index' => 'list',
            'show' => 'detail',
            'update' => 'update',
            'destroy' => 'delete',
        ];
        if (isset($map[$action])) {
            $action = $map[$action];
        }
        return Str::slug("$title.$action", '.');
    }

    protected function getPaginationParameters(): array
    {
        $request = request();
        $format = $request->__format;
        if ($format == 'data-table') {
            $perPage = $request->length;
            $page = intval($request->start / $perPage) + 1;
        } else {
            $perPage = $request->limit;
            $page = $request->page;
        }
        return [$perPage, ['*'], 'page', $page];
    }

    protected function hasExtraField($field): bool
    {
        if ($this->extraFields === null) {
            $extraFieldsStr = request()->input("extra_fields", '');
            $this->extraFields = explode(',', $extraFieldsStr);
        }
        do_log(sprintf("field: %s, extraFields: %s", $field, json_encode($this->extraFields)));
        return in_array($field, $this->extraFields);
    }

    protected function appendExtraSettings(array &$additional, array $names): void
    {
        if ($this->extraSettingNames === null) {
            $extraSettingStr = request()->input("extra_settings", '');
            $this->extraSettingNames = explode(',', $extraSettingStr);
        }
        $results = [];
        foreach ($names as $name) {
            if (in_array($name, $this->extraSettingNames)) {
                $results[$name] = get_setting($name);
            }
        }
        if (!empty($results)) {
            $additional['extra_settings'] = $results;
        }
    }

}
