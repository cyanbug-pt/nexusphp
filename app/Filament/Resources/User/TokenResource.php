<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\User\TokenResource\Pages\ManageTokens;
use App\Filament\Resources\User\TokenResource\Pages;
use App\Filament\Resources\User\TokenResource\RelationManagers;
use App\Models\PersonalAccessToken;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class TokenResource extends Resource
{
    protected static ?string $model = PersonalAccessToken::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 6;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.token');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->label(__('label.name')),
                TextColumn::make('abilities')
                    ->label(__('token.permission'))
                    ->formatStateUsing(fn ($record): string => $record->abilitiesText)
                ,
                TextColumn::make('token')->label(__('token.token')),
                TextColumn::make('tokenable_id')
                    ->label(__('label.username'))
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                ,
                TextColumn::make('last_used_at')->label(__('token.last_used_at')),
                TextColumn::make('expires_at')->label(__('label.expire_at')),
                TextColumn::make('created_at')->label(__('label.created_at')),
            ])
            ->filters([
                //
            ])
            ->recordActions([
//                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTokens::route('/'),
        ];
    }
}
