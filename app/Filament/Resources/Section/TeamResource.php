<?php

namespace App\Filament\Resources\Section;

use Filament\Schemas\Schema;
use App\Filament\Resources\Section\TeamResource\Pages\ListTeams;
use App\Filament\Resources\Section\TeamResource\Pages\CreateTeam;
use App\Filament\Resources\Section\TeamResource\Pages\EditTeam;
use App\Filament\Resources\Section\TeamResource\Pages;
use App\Filament\Resources\Section\TeamResource\RelationManagers;
use App\Models\Team;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends CodecResource
{
    protected static ?string $model = Team::class;

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return parent::form($schema);
    }

    public static function table(Table $table): Table
    {
        return parent::table($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeams::route('/'),
            'create' => CreateTeam::route('/create'),
            'edit' => EditTeam::route('/{record}/edit'),
        ];
    }
}
