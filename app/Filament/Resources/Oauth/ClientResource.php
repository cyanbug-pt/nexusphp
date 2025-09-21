<?php

namespace App\Filament\Resources\Oauth;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Oauth\ClientResource\Pages\ManageClients;
use App\Filament\OptionsTrait;
use App\Filament\PageListSingle;
use App\Filament\Resources\Oauth\ClientResource\Pages;
use App\Filament\Resources\Oauth\ClientResource\RelationManagers;
use App\Models\OauthClient;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = OauthClient::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Oauth';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.oauth_client');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label(__('label.name'))->required(),
                TextInput::make('redirect')->label(__('oauth.redirect'))->required(),
                Radio::make('skips_authorization')
                    ->options(self::getYesNoOptions())
                    ->inline()
                    ->default(0)
                    ->label(__('oauth.skips_authorization')),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->label(__('label.name')),
                TextColumn::make('secret')->label(__('oauth.secret')),
                TextColumn::make('redirect')->label(__('oauth.redirect')),
                IconColumn::make('skips_authorization')
                    ->boolean()
                    ->label(__('oauth.skips_authorization'))
                ,

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageClients::route('/'),
        ];
    }
}
