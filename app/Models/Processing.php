<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;

class Processing extends NexusModel
{
    use NexusActivityLogTrait;

    protected $table = 'processings';

    protected $fillable = ['name', 'sort_index', 'mode',];

    public static function getLabelName()
    {
        return nexus_trans('searchbox.sub_category_processing_label');
    }

    public function search_box()
    {
        return $this->belongsTo(SearchBox::class, 'mode', 'id');
    }
}
