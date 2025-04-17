<?php
namespace App\Repositories;

use App\Enums\Permission\RoutePermissionEnum;

class TokenRepository extends BaseRepository
{
    private static array $userTokenPermissions = [
        RoutePermissionEnum::TORRENT_LIST,
        RoutePermissionEnum::TORRENT_VIEW,
        RoutePermissionEnum::TORRENT_UPLOAD,
        RoutePermissionEnum::USER_VIEW,
    ];

    public function listUserTokenPermissions(): array
    {
        $result = [];
        foreach (self::$userTokenPermissions as $permission) {
            $result[$permission->value] = nexus_trans("route-permission.{$permission->value}.text");
        }
        return $result;
    }
}
