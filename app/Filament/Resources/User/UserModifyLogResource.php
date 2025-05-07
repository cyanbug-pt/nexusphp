<?php

namespace App\Filament\Resources\User;

use App\Filament\Resources\User\UserModifyLogResource\Pages;
use App\Filament\Resources\User\UserModifyLogResource\RelationManagers;
use App\Models\UserModifyLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserModifyLogResource extends Resource
{
    protected static ?string $model = UserModifyLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'User';

    protected static ?int $navigationSort = 100;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.user_modify_logs');
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
                Tables\Columns\TextColumn::make('user_id')
                    ->label(nexus_trans("label.username"))
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                ,
                Tables\Columns\TextColumn::make('content')->label(nexus_trans("user-modify-log.content")),
                Tables\Columns\TextColumn::make('created_at')->label(nexus_trans("label.created_at")),
            ])
            ->filters([
                //
            ])
            ->defaultSort('id', 'desc')
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUserModifyLogs::route('/'),
        ];
    }
}
