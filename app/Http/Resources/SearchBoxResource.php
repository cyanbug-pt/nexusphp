<?php

namespace App\Http\Resources;

use App\Models\SearchBox;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchBoxResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var SearchBox $resource */
        $searchBox = $this->resource;
        $out = [
            'id' => $this->id,
            'name' => $this->displaySectionName,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
        if ($searchBox->showsubcat) {
            $subCategories = [];
            $lang = get_langfolder_cookie();
            $fields = array_keys(SearchBox::$taxonomies);
            if (!empty($searchBox->extra['taxonomy_labels'])) {
                $fields = array_column($searchBox->extra['taxonomy_labels'], 'torrent_field');
            }
            foreach ($fields as $field) {
                $relationName = "taxonomy_$field";
                if ($searchBox->relationLoaded($relationName)) {
                    $subCategories[] = [
                        'field' => $field,
                        'label' => $item['display_text'][$lang] ?? (nexus_trans("searchbox.sub_category_{$field}_label") ?: ucfirst($field)),
                        'data' => MediaResource::collection($searchBox->{$relationName}),
                    ];
                }
            }
            if (!empty($subCategories)) {
                $out['sub_categories'] = $subCategories;
            }
        }
        return $out;
    }
}
