<?php

namespace App\Filament\Resources\User;

use App\Filament\Resources\User\TokenResource\Pages;
use App\Filament\Resources\User\TokenResource\RelationManagers;
use App\Models\PersonalAccessToken;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class TokenResource extends Resource
{
    protected static ?string $model = PersonalAccessToken::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'User';

    protected static ?int $navigationSort = 6;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.token');
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
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')->label(__('label.name')),
                Tables\Columns\TextColumn::make('abilities')
                    ->label(__('token.permission'))
                    ->formatStateUsing(fn ($record): string => $record->abilitiesText)
                ,
                Tables\Columns\TextColumn::make('token')->label(__('token.token')),
                Tables\Columns\TextColumn::make('tokenable_id')
                    ->label(__('label.username'))
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                ,
                Tables\Columns\TextColumn::make('last_used_at')->label(__('token.last_used_at')),
                Tables\Columns\TextColumn::make('expires_at')->label(__('label.expire_at')),
                Tables\Columns\TextColumn::make('created_at')->label(__('label.created_at')),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ManageTokens::route('/'),
        ];
    }
}
