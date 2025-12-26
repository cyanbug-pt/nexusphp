<?php
namespace App\Repositories;

use App\Models\AnnounceLog;
use ClickHouseDB\Client;
use Nexus\Database\NexusDB;

class AnnounceLogRepository extends BaseRepository
{
    const TABLE = 'announce_logs';

    public function listAll(array $filters, int $page, int $perPage, ?string $sortColumn, ?string $sortDirection)
    {
        $beginTimestamp = microtime(true);
        do_log(sprintf(
            "[REQUEST_CLICKHOUSE] [BEGIN], filters: %s, page: %s, perPage: %s, sortColumn: %s, sortDirection: %s",
            json_encode($filters), $page, $perPage, $sortColumn, $sortDirection
        ));
        $totalAlias = "total";
        $offset = ($page - 1) * $perPage;
        $client = $this->getClient();
        $bindFields = $bindValues = [];
        foreach ($filters as $key => $value) {
            $bindFields[] = "$key = :$key";
            if ($key == "event" && $value == "none") {
                $value = "";
            }
            $bindValues[$key] = $value;
        }
        $selectPrefix = sprintf("select * from %s", self::TABLE);
        $countPrefix = sprintf("select count(*) as %s from %s", $totalAlias, self::TABLE);
        $whereStr = "";
        if (count($bindFields) > 0) {
            $whereStr = " where " . implode(" and ", $bindFields);
        }
        $selectSql = sprintf(
            "%s %s order by %s %s limit %d offset %d",
            $selectPrefix, $whereStr, $sortColumn ?: "timestamp", $sortDirection ?: "desc", $perPage, $offset
        );
        $countSql = sprintf("%s %s", $countPrefix, $whereStr);
        $data = $client->select($selectSql, $bindValues);
        $total = $client->select($countSql, $bindValues)->rows()[0][$totalAlias] ?? 0;
        do_log(sprintf(
            "[REQUEST_CLICKHOUSE] [END], selectSql: %s, binds: %s, costTime: %.3f sec.",
            $selectSql, json_encode($bindValues), microtime(true) - $beginTimestamp
        ));
        return [
            'data' => $data->rows(),
            'total' => (int)$total,
            'page' => $page,
            'perPage' => $perPage,
        ];
    }

    private function getClient(): Client
    {
        return app(Client::class);
    }

    public function getById(?string $id): ?AnnounceLog
    {
        if (empty($id)) {
            return null;
        }
        $sql = sprintf("select * from %s where request_id = :id limit 1", self::TABLE);
        $statement = $this->getClient()->select($sql, ['id' => $id]);
        $arr = $statement->fetchOne();
        return $arr ? new AnnounceLog($arr) : null;
    }

    public function listMaxUploadedUser(int $hours)
    {
        $sql = sprintf(
            "select user_id, sum(uploaded_increment) as uploaded_total from %s where timestamp >= now() - INTERVAL %d HOUR group by user_id order by uploaded_total desc limit 5",
            self::TABLE, $hours
        );
        $data = $this->getClient()->select($sql);
        return $data->rows();
    }

}
