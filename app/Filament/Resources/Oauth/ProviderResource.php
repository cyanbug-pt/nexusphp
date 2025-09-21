<?php

namespace App\Filament\Resources\Oauth;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Oauth\ProviderResource\Pages\ManageProviders;
use App\Filament\Resources\Oauth\ProviderResource\Pages;
use App\Filament\Resources\Oauth\ProviderResource\RelationManagers;
use App\Models\OauthProvider;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nexus\Database\NexusDB;
use Ramsey\Uuid;

class ProviderResource extends Resource
{
    protected static ?string $model = OauthProvider::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Oauth';

    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.oauth_provider');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('label.name'))
                    ->required()
                ,
                TextInput::make('client_id')
                    ->label(__('oauth.client_id'))
                    ->required()
                ,
                TextInput::make('client_secret')
                    ->label(__('oauth.secret'))
                    ->required()
                ,
                TextInput::make('authorization_endpoint_url')
                    ->label(__('oauth.authorization_endpoint_url'))
                    ->required()
                ,
                TextInput::make('token_endpoint_url')
                    ->label(__('oauth.token_endpoint_url'))
                    ->required()
                ,
                TextInput::make('user_info_endpoint_url')
                    ->label(__('oauth.user_info_endpoint_url'))
                    ->required()
                ,
                TextInput::make('id_claim')
                    ->label(__('oauth.id_claim'))
                    ->required()
                ,
                TextInput::make('email_claim')
                    ->label(__('oauth.email_claim'))
                    ->required()
                ,
                TextInput::make('username_claim')
                    ->label(__('oauth.username_claim'))
                ,

                TextInput::make('level_claim')
                    ->label(__('oauth.level_claim'))
                ,
                TextInput::make('level_limit')
                    ->numeric()
                    ->label(__('oauth.level_limit'))
                    ->helperText(__('oauth.level_limit_help'))
                ,
                TextInput::make('priority')
                    ->label(__('label.priority'))
                    ->default(0)
                    ->numeric()
                    ->helperText(__('label.priority_help'))
                ,
                Toggle::make('enabled')
                    ->label(__('label.enabled'))
                ,
                TextInput::make('redirect')
                    ->default(fn ($record) => OauthProvider::getCallbackUrl($record->uuid ?? self::getNewUuid()))
                    ->disabled()
                    ->label(__('oauth.redirect'))
                    ->columnSpanFull()
                ,
            ]);
    }

    private static function getNewUuid(): string
    {
        return NexusDB::remember("new_oauth_provider_uuid", 86400 * 365, function () {
            return UUid\v4();
        });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->label(__('label.name')),
                TextColumn::make('client_id')->label(__('oauth.client_id')),
                TextColumn::make('client_secret')->label(__('oauth.secret')),
                TextColumn::make('authorization_endpoint_url')->label(__('oauth.authorization_endpoint_url')),
                TextColumn::make('uuid')
                    ->label(__('oauth.redirect'))
                    ->formatStateUsing(fn ($state) => url("/oauth/callback/$state"))
                ,
                TextColumn::make('priority')->label(__('label.priority')),
                TextColumn::make('updated_at')->label(__('label.updated_at')),
                TextColumn::make('level_limit')->label(__('oauth.level_limit')),
                IconColumn::make('enabled')->boolean()->label(__('label.enabled')),
            ])
            ->defaultSort('priority', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
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
            'index' => ManageProviders::route('/'),
        ];
    }
}
