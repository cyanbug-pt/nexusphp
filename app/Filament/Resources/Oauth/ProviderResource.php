<?php

namespace App\Filament\Resources\Oauth;

use App\Filament\Resources\Oauth\ProviderResource\Pages;
use App\Filament\Resources\Oauth\ProviderResource\RelationManagers;
use App\Models\OauthProvider;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Oauth';

    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.oauth_provider');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('label.name'))
                    ->required()
                ,
                Forms\Components\TextInput::make('client_id')
                    ->label(__('oauth.client_id'))
                    ->required()
                ,
                Forms\Components\TextInput::make('client_secret')
                    ->label(__('oauth.secret'))
                    ->required()
                ,
                Forms\Components\TextInput::make('authorization_endpoint_url')
                    ->label(__('oauth.authorization_endpoint_url'))
                    ->required()
                ,
                Forms\Components\TextInput::make('token_endpoint_url')
                    ->label(__('oauth.token_endpoint_url'))
                    ->required()
                ,
                Forms\Components\TextInput::make('user_info_endpoint_url')
                    ->label(__('oauth.user_info_endpoint_url'))
                    ->required()
                ,
                Forms\Components\TextInput::make('id_claim')
                    ->label(__('oauth.id_claim'))
                    ->required()
                ,
                Forms\Components\TextInput::make('email_claim')
                    ->label(__('oauth.email_claim'))
                    ->required()
                ,
                Forms\Components\TextInput::make('username_claim')
                    ->label(__('oauth.username_claim'))
                ,

                Forms\Components\TextInput::make('level_claim')
                    ->label(__('oauth.level_claim'))
                ,
                Forms\Components\TextInput::make('level_limit')
                    ->numeric()
                    ->label(__('oauth.level_limit'))
                    ->helperText(__('oauth.level_limit_help'))
                ,
                Forms\Components\TextInput::make('priority')
                    ->label(__('label.priority'))
                    ->default(0)
                    ->numeric()
                    ->helperText(__('label.priority_help'))
                ,
                Forms\Components\Toggle::make('enabled')
                    ->label(__('label.enabled'))
                ,
                Forms\Components\TextInput::make('redirect')
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
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')->label(__('label.name')),
                Tables\Columns\TextColumn::make('client_id')->label(__('oauth.client_id')),
                Tables\Columns\TextColumn::make('client_secret')->label(__('oauth.secret')),
                Tables\Columns\TextColumn::make('authorization_endpoint_url')->label(__('oauth.authorization_endpoint_url')),
                Tables\Columns\TextColumn::make('uuid')
                    ->label(__('oauth.redirect'))
                    ->formatStateUsing(fn ($state) => url("/oauth/callback/$state"))
                ,
                Tables\Columns\TextColumn::make('priority')->label(__('label.priority')),
                Tables\Columns\TextColumn::make('updated_at')->label(__('label.updated_at')),
                Tables\Columns\TextColumn::make('level_limit')->label(__('oauth.level_limit')),
                Tables\Columns\IconColumn::make('enabled')->boolean()->label(__('label.enabled')),
            ])
            ->defaultSort('priority', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProviders::route('/'),
        ];
    }
}
