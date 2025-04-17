<?php

namespace App\Auth;

use App\Enums\Permission\PermissionEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Permission
{
    public static function canUploadToSpecialSection(): bool
    {
        return self::canUploadToNormalSection() && user_can(PermissionEnum::UPLOAD_TO_SPECIAL_SECTION->value);
    }

    public static function canUploadToNormalSection(): bool
    {
        $user = Auth::user();
        return $user->uploadpos == "yes" && user_can(PermissionEnum::UPLOAD->value);
    }

    public static function canViewSpecialSection(): bool
    {
        return user_can(PermissionEnum::TORRENT_VIEW_SPECIAL->value);
    }

    public static function canBeAnonymous(): bool
    {
        return user_can(PermissionEnum::BE_ANONYMOUS->value);
    }

    public static function canSetTorrentHitAndRun(): bool
    {
        return user_can(PermissionEnum::TORRENT_SET_HR->value);
    }

    public static function canSetTorrentPrice(): bool
    {
        return user_can(PermissionEnum::TORRENT_SET_PRICE->value);
    }

    public static function canSetTorrentPosState(): bool
    {
        return user_can(PermissionEnum::TORRENT_SET_STICKY->value);
    }

    public static function canTorrentApprovalAllowAutomatic(): bool
    {
        return user_can(PermissionEnum::TORRENT_APPROVAL_ALLOW_AUTOMATIC->value);
    }

    public static function canManageTorrent(): bool
    {
        return user_can(PermissionEnum::TORRENT_MANAGE->value);
    }

    public static function canPickTorrent(): bool
    {
        $user = Auth::user();
        return $user->picker == "yes" && self::canManageTorrent() || $user->class >= User::CLASS_SYSOP;
    }

    public static function canSetTorrentSpecialTag(): bool
    {
        return user_can(PermissionEnum::TORRENT_SET_SPECIAL_TAG->value);
    }

    public static function canManageUserBasicInfo(): bool
    {
        return user_can(PermissionEnum::MANAGE_USER_BASIC_INFO->value);
    }

    public static function canManageUserConfidentialInfo(): bool
    {
        return user_can(PermissionEnum::MANAGE_USER_CONFIDENTIAL_INFO->value);
    }

    public static function canViewUserConfidentialInfo(): bool
    {
        return user_can(PermissionEnum::VIEW_USER_CONFIDENTIAL_INFO->value);
    }
}
