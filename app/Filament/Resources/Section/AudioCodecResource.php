<?php

namespace App\Filament\Resources\Section;

use Filament\Schemas\Schema;
use App\Filament\Resources\Section\AudioCodecResource\Pages\ListAudioCodecs;
use App\Filament\Resources\Section\AudioCodecResource\Pages\CreateAudioCodec;
use App\Filament\Resources\Section\AudioCodecResource\Pages\EditAudioCodec;
use App\Filament\Resources\Section\AudioCodecResource\Pages;
use App\Filament\Resources\Section\AudioCodecResource\RelationManagers;
use App\Models\AudioCodec;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AudioCodecResource extends CodecResource
{
    protected static ?string $model = AudioCodec::class;

    protected static ?int $navigationSort = 4;

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
            'index' => ListAudioCodecs::route('/'),
            'create' => CreateAudioCodec::route('/create'),
            'edit' => EditAudioCodec::route('/{record}/edit'),
        ];
    }
}
