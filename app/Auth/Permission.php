<?php

namespace App\Auth;

use App\Enums\PermissionEnum;

class Permission
{
    public static function canUploadToSpecialSection(): bool
    {
        return user_can(PermissionEnum::UPLOAD_TO_SPECIAL_SECTION->value);
    }
}
