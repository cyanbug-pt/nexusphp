<?php

namespace App\Filament\Resources\Section\TeamResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\PageList;
use App\Filament\Resources\Section\TeamResource;
use App\Models\Standard;
use App\Models\Team;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTeams extends PageList
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Team::query()->with('search_box')->orderBy('mode', 'asc');
    }
}
