<?php

namespace App\Console\Commands;

use App\Enums\ModelEventEnum;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Nexus\Database\NexusDB;
use Symfony\Component\Console\Command\Command as CommandAlias;

class FireEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:fire {--name=} {--idKey=} {--idKeyOld=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fire an event, options: --name, --idKey --idKeyOld';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->option('name');
        $idKey = $this->option('idKey');
        $idKeyOld = $this->option('idKeyOld');
        $log = "FireEvent, name: $name, idKey: $idKey, idKeyOld: $idKeyOld";
        $this->info("$log, begin ...");
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
            publish_model_event($name, $model->id);
        } else {
            $log .= ", no event match this name";
        }
        $this->info($log);
        do_log($log);
        return CommandAlias::SUCCESS;
    }
}
