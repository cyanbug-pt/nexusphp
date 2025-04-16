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
    protected $signature = 'event:fire {--name=} {--idKey=} {--idKeyOld=""}';

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
        if (isset(ModelEventEnum::$eventMaps[$name])) {
            $eventName = ModelEventEnum::$eventMaps[$name]['event'];
            $model = unserialize(NexusDB::cache_get($idKey));
            if ($model instanceof Model) {
                $params = [$model];
                if ($idKeyOld) {
                    $modelOld = unserialize(NexusDB::cache_get($idKeyOld));
                    if ($modelOld instanceof Model) {
                        $params[] = $modelOld;
                    } else {
                        $log .= ", invalid idKeyOld";
                    }
                }
                $result = call_user_func_array([$eventName, "dispatch"], $params);
                $log .= ", success call dispatch, result: " . var_export($result, true);
                publish_model_event($name, $model->id);
            } else {
                $log .= ", invalid argument to call, it should be instance of: " . Model::class;
            }
        } else {
            $log .= ", no event match this name";
        }
        $this->info($log);
        do_log($log);
        return CommandAlias::SUCCESS;
    }
}
