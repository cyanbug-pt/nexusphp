<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\User\LoginLogResource\Pages\ManageLoginLogs;
use App\Filament\Resources\User\LoginLogResource\Pages;
use App\Filament\Resources\User\LoginLogResource\RelationManagers;
use App\Models\LoginLog;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoginLogResource extends Resource
{
    protected static ?string $model = LoginLog::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 9;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.login_log');
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
                TextColumn::make('id')->sortable(),
                TextColumn::make('uid')
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                    ->label(__('label.username'))
                ,
                TextColumn::make('ip')->searchable(),
                TextColumn::make('country')->label(__('label.country'))->searchable(),
                TextColumn::make('city')->label(__('label.city'))->searchable(),
                TextColumn::make('client')->label(__('label.client')),
                TextColumn::make('created_at')->label(__('label.created_at')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('uid')
                    ->schema([
                        TextInput::make('uid')
                            ->label(__('label.username'))
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn (Builder $query, $value) => $query->where("uid", $value));
                    })
                ,
            ])
            ->recordActions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageLoginLogs::route('/'),
        ];
    }
}
