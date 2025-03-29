<?php

namespace App\Enums\Permission;

enum PermissionEnum: string {
    case UPLOAD_TO_SPECIAL_SECTION = 'uploadspecial';
    case BE_ANONYMOUS = 'beanonymous';

    case TORRENT_LIST = 'torrent:list';
    case UPLOAD = 'upload';
}
