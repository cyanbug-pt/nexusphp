<?php

namespace App\Filament\Resources\Oauth;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Oauth\AuthCodeResource\Pages\ManageAuthCodes;
use App\Filament\Resources\Oauth\AuthCodeResource\Pages;
use App\Filament\Resources\Oauth\AuthCodeResource\RelationManagers;
use Laravel\Passport\AuthCode;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuthCodeResource extends Resource
{
    protected static ?string $model = AuthCode::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Oauth';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.oauth_auth_code');
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
                TextColumn::make('user_id')
                    ->label(__('label.username'))
                    ->formatStateUsing(fn ($record) => username_for_admin($record->user_id)),
                TextColumn::make('client.name')
                    ->label(__('oauth.client')),
                TextColumn::make('expires_at')
                    ->label(__('label.expire_at'))
            ])
            ->filters([
                //
            ])
            ->recordActions([
//                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAuthCodes::route('/'),
        ];
    }
}
