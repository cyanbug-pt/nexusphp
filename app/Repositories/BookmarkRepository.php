<?php

namespace App\Repositories;

use App\Exceptions\NexusException;
use App\Models\Bookmark;
use App\Models\Torrent;
use App\Models\User;

class BookmarkRepository extends BaseRepository
{
    public function add(User $user, $torrentId)
    {
        $torrent = Torrent::query()->find($torrentId);
        if (!$torrent) {
            throw new NexusException(nexus_trans('bookmark.torrent_not_exists', ['torrent_id' => $torrentId]));
        }
        $torrent->checkIsNormal();
        $exists = $user->bookmarks()->where('torrentid', $torrentId)->exists();
        if ($exists) {
            throw new NexusException(nexus_trans('bookmark.torrent_already_bookmarked', ['torrent_id' => $torrentId]));
        }
        $result = $user->bookmarks()->create(['torrentid' => $torrentId]);
        return $result;
    }

    public function remove(User $user, $torrentId)
    {
        /**
         * @var Bookmark $record
         */
        $record = $user->bookmarks()->where('torrentid', $torrentId)->first();
        if (!$record) {
            throw new NexusException(nexus_trans('bookmark.torrent_has_not_been_bookmarked', ['torrent_id' => $torrentId]));
        }
        do_log("going to remove bookmark of torrent: $torrentId");
        $record->delete();
        return true;
    }
}
