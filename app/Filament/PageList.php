<?php

namespace App\Filament;

use Filament\Support\Enums\Width;
use Closure;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Filters\Layout;
use Illuminate\Database\Eloquent\Model;

class PageList extends ListRecords
{
    protected Width|string|null $maxContentWidth = 'full';

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return function (Model $record): ?string {
            return null;
        };
    }

    protected function getTableFiltersLayout(): ?string
    {
        return FiltersLayout::AboveContent;
    }
}
