<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use App\Filament\Resources\User\InviteResource\Pages\ListInvites;
use App\Filament\Resources\User\InviteResource\Pages\CreateInvite;
use App\Filament\Resources\User\InviteResource\Pages\EditInvite;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use App\Filament\OptionsTrait;
use App\Filament\Resources\User\InviteResource\Pages;
use App\Filament\Resources\User\InviteResource\RelationManagers;
use App\Models\Invite;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InviteResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = Invite::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-plus';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 7;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.invite');
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
                TextColumn::make('inviter')
                    ->label(__('invite.fields.inviter'))
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                ,
                TextColumn::make('invitee')
                    ->label(__('invite.fields.invitee'))
                    ->searchable()
                ,
                TextColumn::make('hash')
                ,
                TextColumn::make('time_invited')
                    ->label(__('invite.fields.time_invited'))
                ,
                IconColumn::make('valid')
                    ->label(__('invite.fields.valid'))
                    ->boolean()
                ,
                TextColumn::make('invitee_register_uid')
                    ->label(__('invite.fields.invitee_register_uid'))
                    ->searchable()
                ,
                TextColumn::make('invitee_register_email')
                    ->label(__('invite.fields.invitee_register_email'))
                    ->searchable()
                ,
                TextColumn::make('invitee_register_username')
                    ->label(__('invite.fields.invitee_register_username'))
                    ->searchable()
                ,
                TextColumn::make('expired_at')
                    ->label(__('invite.fields.expired_at'))
                    ->formatStateUsing(fn ($state) => format_datetime($state))
                ,
                TextColumn::make('created_at')
                    ->label(__('label.created_at'))
                    ->formatStateUsing(fn ($state) => format_datetime($state))
                ,
            ])
            ->defaultSort('id', 'desc')
            ->filters(self::getFilters())
            ->recordActions([
//                Tables\Actions\EditAction::make(),
            ])
            ->toolbarActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInvites::route('/'),
            'create' => CreateInvite::route('/create'),
            'edit' => EditInvite::route('/{record}/edit'),
        ];
    }

    private static function getFilters()
    {
        $filters = [];
        $filters[] = Filter::make('inviter')
            ->schema([
                TextInput::make('inviter')
                    ->label(__('invite.fields.inviter'))
                    ->placeholder('UID')
                ,
            ])->query(function (Builder $query, array $data) {
                return $query->when($data['inviter'], fn (Builder $query, $value) => $query->where("inviter", $value));
            })
        ;
        $filters[] = SelectFilter::make('valid')
            ->options(self::getYesNoOptions())
            ->label(__('invite.fields.valid'))
        ;
        $filters[] = Filter::make('time_invited_begin')
            ->schema([
                DatePicker::make('time_invited_begin')
                    ->maxDate(now())
                    ->label(__('invite.fields.time_invited_begin'))
                ,
            ])->query(function (Builder $query, array $data) {
                return $query->when($data['time_invited_begin'], fn (Builder $query, $value) => $query->where("time_invited", '>=', $value));
            })
        ;
        $filters[] = Filter::make('time_invited_end')
            ->schema([
                DatePicker::make('time_invited_end')
                    ->maxDate(now())
                    ->label(__('invite.fields.time_invited_end'))
                ,
            ])->query(function (Builder $query, array $data) {
                return $query->when($data['time_invited_end'], fn (Builder $query, $value) => $query->where("time_invited", '<=', $value));
            })
        ;
        return $filters;
    }
}
