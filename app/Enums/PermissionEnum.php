<?php

namespace App\Enums;

enum PermissionEnum: string {
    case UPLOAD_TO_SPECIAL_SECTION = 'uploadspecial';
    case BE_ANONYMOUS = 'beanonymous';
}
