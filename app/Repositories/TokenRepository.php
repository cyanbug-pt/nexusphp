<?php
namespace App\Repositories;

use App\Enums\Permission\RoutePermissionEnum;
use App\Models\Setting;

class TokenRepository extends BaseRepository
{
    private static array $userTokenPermissions = [
        RoutePermissionEnum::TORRENT_LIST->value,
        RoutePermissionEnum::TORRENT_VIEW->value,
        RoutePermissionEnum::TORRENT_UPLOAD->value,
        RoutePermissionEnum::USER_VIEW->value,
        RoutePermissionEnum::BOOKMARK_STORE->value,
        RoutePermissionEnum::BOOKMARK_DELETE->value,
    ];

    public static function listUserTokenPermissions(bool $format = true): array
    {
        if (!$format) {
            return self::$userTokenPermissions;
        }
        return self::formatPermissions(self::$userTokenPermissions);
    }

    public static function listUserTokenPermissionAllowed(): array
    {
        return self::formatPermissions(Setting::getPermissionUserTokenAllowed());
    }

    private static function formatPermissions(array $permissions): array
    {
        $result = [];
        foreach ($permissions as $permission) {
            $result[$permission] = nexus_trans("route-permission.{$permission}.text");
        }
        return $result;
    }
}
