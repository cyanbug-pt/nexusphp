<?php

$dbConfig = nexus_config('nexus.database');
$config = $dbConfig['connections'][$dbConfig['default']];
\Nexus\Database\NexusDB::bootEloquent($config);


