<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;

class Source extends NexusModel
{
    use NexusActivityLogTrait;

    protected $fillable = ['name', 'sort_index', 'mode',];

    public static function getLabelName()
    {
        return nexus_trans('searchbox.sub_category_source_label');
    }

    public function search_box()
    {
        return $this->belongsTo(SearchBox::class, 'mode', 'id');
    }
}
