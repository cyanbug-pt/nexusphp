<?php

namespace App\Filament\Resources\Section;

use Filament\Schemas\Schema;
use App\Filament\Resources\Section\SourceResource\Pages\ListSources;
use App\Filament\Resources\Section\SourceResource\Pages\CreateSource;
use App\Filament\Resources\Section\SourceResource\Pages\EditSource;
use App\Filament\Resources\Section\SourceResource\Pages;
use App\Filament\Resources\Section\SourceResource\RelationManagers;
use App\Models\Source;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SourceResource extends CodecResource
{
    protected static ?string $model = Source::class;

    protected static ?int $navigationSort = 7;

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
            'index' => ListSources::route('/'),
            'create' => CreateSource::route('/create'),
            'edit' => EditSource::route('/{record}/edit'),
        ];
    }
}
