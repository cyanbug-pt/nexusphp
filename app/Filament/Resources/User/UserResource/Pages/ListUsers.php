<?php

namespace App\Filament\Resources\User\UserResource\Pages;

use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\PageList;
use App\Filament\Resources\User\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\Layout;

class ListUsers extends PageList implements HasActions
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

//    public function isTableSearchable(): bool
//    {
//        return true;
//    }


    protected function getTableFiltersLayout(): ?string
    {
        return FiltersLayout::AboveContent;
    }

}
