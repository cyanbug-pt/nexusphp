<?php

namespace App\Filament\Resources\Section;

use Filament\Schemas\Schema;
use App\Filament\Resources\Section\ProcessingResource\Pages\ListProcessings;
use App\Filament\Resources\Section\ProcessingResource\Pages\CreateProcessing;
use App\Filament\Resources\Section\ProcessingResource\Pages\EditProcessing;
use App\Filament\Resources\Section\ProcessingResource\Pages;
use App\Filament\Resources\Section\ProcessingResource\RelationManagers;
use App\Models\Processing;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProcessingResource extends CodecResource
{
    protected static ?string $model = Processing::class;

    protected static ?int $navigationSort = 9;

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
            'index' => ListProcessings::route('/'),
            'create' => CreateProcessing::route('/create'),
            'edit' => EditProcessing::route('/{record}/edit'),
        ];
    }
}
