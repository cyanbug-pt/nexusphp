<?php

namespace App\Jobs;

use App\Enums\ModelEventEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Nexus\Database\NexusDB;

class FireEvent implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $name, public string $idKey, public string $idKeyOld = "")
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $name = $this->name;
        $idKey = $this->idKey;
        $idKeyOld = $this->idKeyOld;
        $log = "Job FireEvent, name: $name, idKey: $idKey, idKeyOld: $idKeyOld";
        do_log("$log, begin ...");
        if (isset(ModelEventEnum::$eventMaps[$name])) {
            $eventName = ModelEventEnum::$eventMaps[$name]['event'];
            $modelClassName = ModelEventEnum::$eventMaps[$name]['model'];
            $modelBasic = new $modelClassName();
            $modelData = unserialize(NexusDB::cache_get($idKey));
            $useArray = str_ends_with($name, '_deleted');
            $model = call_user_func_array([$modelBasic, "newInstance"], [$modelData, true]);
            //由于 id 不属于 fillable，初始化新对象时是没有值的
            $model->id = $modelData['id'];
            $params = [$useArray ? $modelData: $model];
            if ($idKeyOld) {
                $modelOldData = unserialize(NexusDB::cache_get($idKeyOld));
                $modelOld = call_user_func_array([$modelBasic, "newInstance"], [$modelOldData, true]);
                $modelOld->id = $modelOldData['id'];
                $params[] = $useArray ? $modelOldData: $modelOld;
            }
            $result = call_user_func_array([$eventName, "dispatch"], $params);
            $log .= ", success call dispatch, result: " . var_export($result, true);
            publish_model_event($name, $model->id, $model->toJson());
        } else {
            $log .= ", no event match this name";
        }
        do_log($log);
    }
}
