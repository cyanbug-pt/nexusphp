<?php

namespace App\Models;


use App\Models\Traits\NexusActivityLogTrait;

class Category extends NexusModel
{
    use NexusActivityLogTrait;

    protected $table = 'categories';

    protected $fillable = ['mode', 'name', 'class_name', 'image', 'sort_index', 'icon_id'];

    public static function getLabelName()
    {
        return nexus_trans('searchbox.category_label');
    }

    public function icon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Icon::class, 'icon_id');
    }

    public function search_box()
    {
        return $this->belongsTo(SearchBox::class, 'mode', 'id');
    }
}
