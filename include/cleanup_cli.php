<?php

/**
 * do clean in cli
 *
 */

require "bittorrent.php";
require 'cleanup.php';

$logPrefix = "[CLEANUP_CLI]";
$lockFile = sprintf('%s/nexus_cleanup_cli.lock', sys_get_temp_dir());
$fd = fopen($lockFile, 'w+');
if ($fd === false) {
    $log = "$logPrefix, can not open lock file: $lockFile";
    do_log($log, 'error');
    printProgress($log);
    exit(1);
}
if (!flock($fd, LOCK_EX|LOCK_NB)) {
    $log = "$logPrefix, can not get lock, skip!";
    do_log($log);
    printProgress($log);
    exit();
}
register_shutdown_function(function () use ($fd) {
    flock($fd, LOCK_UN);
    fclose($fd);
});

$force = 0;
if (isset($_SERVER['argv'][1])) {
    $force = $_SERVER['argv'][1] ? 1 : 0;
}
$begin = time();
try {
    printProgress("$logPrefix, START, force: $force");
    if ($force) {
        $result = docleanup(1, true);
    } else {
        $result = autoclean(true);
    }
} catch (\Throwable $throwable) {
    $log = "$logPrefix, ERROR: " . $throwable->getMessage() . "\n" . $throwable->getTraceAsString();
    do_log($log, 'error');
    printProgress($log);
    exit(1);
}
$log = "$logPrefix, DONE: $result, cost time in seconds: " . (time() - $begin);
do_log($log);
printProgress($log);
