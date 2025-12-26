<?php

namespace App\Filament\Resources\Torrent;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Torrent\TagResource\Pages\ListTags;
use App\Filament\Resources\Torrent\TagResource\Pages\CreateTag;
use App\Filament\Resources\Torrent\TagResource\Pages\EditTag;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use App\Filament\Resources\Torrent\TagResource\Pages;
use App\Filament\Resources\Torrent\TagResource\RelationManagers;
use App\Models\SearchBox;
use App\Models\Tag;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-tag';

    protected static string | \UnitEnum | null $navigationGroup = 'Torrent';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.tags_list');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->label(__('label.name')),
                TextInput::make('color')->required()->label(__('label.tag.color')),
                TextInput::make('font_color')->required()->label(__('label.tag.font_color')),
                TextInput::make('font_size')->required()->label(__('label.tag.font_size')),
                TextInput::make('margin')->required()->label(__('label.tag.margin')),
                TextInput::make('padding')->required()->label(__('label.tag.padding')),
                TextInput::make('border_radius')->required()->label(__('label.tag.border_radius')),
                TextInput::make('priority')->integer()->required()->label(__('label.priority'))->default(0),
                Select::make('mode')
                    ->options(SearchBox::query()->pluck('name', 'id')->toArray())
                    ->label(__('label.search_box.taxonomy.mode'))
                    ->helperText(__('label.search_box.taxonomy.mode_help'))
                ,
                Textarea::make('description')->label(__('label.description')),
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
                TextColumn::make('name')->label(__('label.name'))->searchable(),
                TextColumn::make('color')->label(__('label.tag.color')),
                TextColumn::make('font_color')->label(__('label.tag.font_color')),
                TextColumn::make('font_size')->label(__('label.tag.font_size')),
                TextColumn::make('margin')->label(__('label.tag.margin')),
                TextColumn::make('padding')->label(__('label.tag.padding')),
                TextColumn::make('border_radius')->label(__('label.tag.border_radius')),
                TextColumn::make('priority')->label(__('label.priority'))->sortable(),
                TextColumn::make('torrents_count')->label(__('label.tag.torrents_count')),
                TextColumn::make('torrents_sum_size')->label(__('label.tag.torrents_sum_size'))->formatStateUsing(fn ($state) => mksize($state)),
//                Tables\Columns\TextColumn::make('updated_at')->dateTime()->label(__('label.updated_at')),
            ])
            ->defaultSort('priority', 'desc')
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
            ->recordActions(self::getActions())
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
            'index' => ListTags::route('/'),
            'create' => CreateTag::route('/create'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }

    private static function getActions(): array
    {
        $actions = [];
        $actions[] = Action::make('detach_torrents')
            ->label(__('admin.resources.tag.detach_torrents'))
            ->requiresConfirmation()
            ->action(function ($record) {
                $record->torrent_tags()->delete();
            });
        $actions[] = EditAction::make();
        return $actions;
    }
}
