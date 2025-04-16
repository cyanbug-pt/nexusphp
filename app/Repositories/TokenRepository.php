<?php
namespace App\Repositories;

use App\Enums\Permission\PermissionEnum;

class TokenRepository extends BaseRepository
{
    private static array $userTokenPermissions = [
        PermissionEnum::TORRENT_LIST,
        PermissionEnum::TORRENT_VIEW,
        PermissionEnum::UPLOAD,
        PermissionEnum::USER_VIEW,
    ];

    public function listUserTokenPermissions(): array
    {
        $result = [];
        foreach (self::$userTokenPermissions as $permission) {
            $result[$permission->value] = nexus_trans("permission.{$permission->value}.text");
        }
        return $result;
    }
}
