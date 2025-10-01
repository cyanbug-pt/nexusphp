<?php

namespace App\Filament\Resources\Oauth;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Oauth\AccessTokenResource\Pages\ManageAccessTokens;
use App\Filament\Resources\Oauth\AccessTokenResource\Pages;
use App\Filament\Resources\Oauth\AccessTokenResource\RelationManagers;
use Laravel\Passport\Token;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccessTokenResource extends Resource
{
    protected static ?string $model = Token::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Oauth';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.oauth_access_token');
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
                TextColumn::make('id')->searchable(),
                TextColumn::make('user.username')
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
            'index' => ManageAccessTokens::route('/'),
        ];
    }
}
