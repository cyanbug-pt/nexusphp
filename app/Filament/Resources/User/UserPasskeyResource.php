<?php

namespace App\Filament\Resources\User;

use App\Filament\Resources\User\UserPasskeyResource\Pages;
use App\Models\Passkey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserPasskeyResource extends Resource
{
    protected static ?string $model = Passkey::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationGroup = 'User';

    protected static ?int $navigationSort = 12;

    public static function getNavigationLabel(): string
    {
        return __('passkey.passkey');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()
                ,
                Tables\Columns\TextColumn::make('user_id')
                    ->formatStateUsing(fn($state) => username_for_admin($state))
                    ->label(__('label.username'))
                ,
                Tables\Columns\TextColumn::make('AAGUID')
                    ->label("AAGUID")
                ,
                Tables\Columns\TextColumn::make('credential_id')
                    ->label(__('passkey.fields.credential_id'))
                ,
                Tables\Columns\TextColumn::make('counter')
                    ->label(__('passkey.fields.counter'))
                ,
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('label.created_at'))
                ,
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\Filter::make('user_id')
                    ->form([
                        Forms\Components\TextInput::make('uid')
                            ->label(__('label.username'))
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn(Builder $query, $value) => $query->where("user_id", $value));
                    })
                ,
                Tables\Filters\Filter::make('credential_id')
                    ->form([
                        Forms\Components\TextInput::make('credential_id')
                            ->label(__('passkey.fields.credential_id'))
                            ->placeholder('Credential ID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['credential_id'], fn(Builder $query, $value) => $query->where("credential_id", $value));
                    })
                ,
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUserPasskey::route('/'),
        ];
    }
}
