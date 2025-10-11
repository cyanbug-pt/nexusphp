<?php

namespace App\Filament;

use Filament\Support\Enums\Width;
use Filament\Tables\Enums\FiltersLayout;
use Closure;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class PageListSingle extends ManageRecords
{
    protected Width|string|null $maxContentWidth = 'full';

    protected function getTableFiltersLayout(): FiltersLayout
    {
        return FiltersLayout::AboveContent;
    }

    protected function getTableRecordActionUsing(): ?Closure
    {
        return null;
    }
}
