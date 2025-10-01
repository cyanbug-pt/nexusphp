<?php

namespace App\Filament\Resources\Oauth;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Oauth\RefreshTokenResource\Pages\ManageRefreshTokens;
use App\Filament\Resources\Oauth\RefreshTokenResource\Pages;
use App\Filament\Resources\Oauth\RefreshTokenResource\RelationManagers;
use Laravel\Passport\RefreshToken;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RefreshTokenResource extends Resource
{
    protected static ?string $model = RefreshToken::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Oauth';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.oauth_refresh_token');
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
                TextColumn::make('id')
                    ->label(__('oauth.refresh_token'))
                    ->searchable()
                ,
                TextColumn::make('access_token_id')
                    ->label(__('oauth.access_token'))
                    ->searchable()
                ,
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
            'index' => ManageRefreshTokens::route('/'),
        ];
    }
}
