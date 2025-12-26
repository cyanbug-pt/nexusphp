<?php

namespace App\Filament\Resources\Section;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Section\CodecResource\Pages\ListCodecs;
use App\Filament\Resources\Section\CodecResource\Pages\CreateCodec;
use App\Filament\Resources\Section\CodecResource\Pages\EditCodec;
use App\Filament\Resources\Section\CodecResource\Pages;
use App\Filament\Resources\Section\CodecResource\RelationManagers;
use App\Models\Codec;
use App\Models\Icon;
use App\Models\SearchBox;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CodecResource extends Resource
{
    protected static ?string $model = Codec::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-bookmark';

    protected static string | \UnitEnum | null $navigationGroup = 'Section';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->label(__('label.search_box.taxonomy.name'))->required(),
                TextInput::make('sort_index')
                    ->default(0)
                    ->label(__('label.priority'))
                    ->helperText(__('label.priority_help'))
                ,
                Select::make('mode')
                    ->options(SearchBox::query()->pluck('name', 'id')->toArray())
                    ->label(__('label.search_box.taxonomy.mode'))
                    ->helperText(__('label.search_box.taxonomy.mode_help'))
                ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('search_box.name')
                    ->label(__('label.search_box.label'))
                    ->formatStateUsing(fn ($record) => $record->search_box->name ?? 'All')
                ,
                TextColumn::make('name')->label(__('label.search_box.taxonomy.name'))->searchable(),
                TextColumn::make('sort_index')->label(__('label.search_box.taxonomy.sort_index'))->sortable(),
            ])
            ->defaultSort('sort_index', 'desc')
            ->filters([
                SelectFilter::make('mode')
                    ->options(SearchBox::query()->pluck('name', 'id')->toArray())
                    ->label(__('label.search_box.taxonomy.mode'))
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['value'], function (Builder $query, $value) {
                            return $query->where(function (Builder $query) use ($value) {
                                return $query->where('mode', $value)->orWhere('mode', 0);
                            });
                        });
                    })
                ,
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
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
            'index' => ListCodecs::route('/'),
            'create' => CreateCodec::route('/create'),
            'edit' => EditCodec::route('/{record}/edit'),
        ];
    }
}
