<?php
namespace App\Repositories;
use App\Auth\Permission;
use App\Exceptions\NexusException;
use App\Models\Category;
use App\Models\SearchBox;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadRepository extends BaseRepository
{
    public function upload(Request $request)
    {
        $user = $request->user();
        if ($user->uploadpos != 'yes') {
            throw new NexusException("user upload permission is disabled");
        }
        $rules = [
            'descr' => 'required',
            'type' => 'required',
            'name' => 'required',
        ];
        $request->validate($rules);
        $category = Category::query()->firstOrFail($request->type);
        $mode = $category->mode;
        $anonymous = "no";
        $uploaderUsername = $user->username;
        if ($request->uplver == 'yes' && user_can('beanonymous')) {
            $anonymous = "yes";
            $uploaderUsername = "Anonymous";
        }



    }

    private function getTorrentFile(Request $request): UploadedFile
    {
        $file = $request->file('file');
        if (empty($file)) {
            throw new NexusException("torrent file not found");
        }
        if (!$file->isValid()) {
            throw new NexusException("upload torrent file error");
        }
        return $file;
    }

    private function getNfoContent(Request $request): string
    {
        $enableNfo = get_setting("main.enablenfo") == "yes";
        if (!$enableNfo) {
            return '';
        }
        $file = $request->file('nfo');
        if (empty($file)) {
            return '';
        }
        if (!$file->isValid()) {
            throw new NexusException("upload nfo file error");
        }
        $size = $file->getSize();
        if ($size == 0) {
            throw new NexusException("upload nfo file size is zero");
        }
        if ($size > 65535) {
            throw new NexusException("upload nfo file size is too large");
        }
        return str_replace("\x0d\x0d\x0a", "\x0d\x0a", $file->getContent());
    }

}
