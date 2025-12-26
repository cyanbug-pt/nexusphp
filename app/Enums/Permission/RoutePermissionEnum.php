<?php

namespace App\Enums\Permission;

enum RoutePermissionEnum: string {
    case TORRENT_LIST = 'torrent:list';
    case TORRENT_VIEW = 'torrent:view';
    case TORRENT_UPLOAD = 'torrent:upload';
    case USER_VIEW = "user:view";
    case BOOKMARK_STORE = "bookmark:store";
    case BOOKMARK_DELETE = "bookmark:delete";
}
