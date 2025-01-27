<?php

namespace App\Filament\Resources\User;

use App\Filament\Resources\User\HitAndRunResource\Pages;
use App\Filament\Resources\User\HitAndRunResource\RelationManagers;
use App\Models\HitAndRun;
use App\Models\User;
use App\Repositories\HitAndRunRepository;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Filament\Infolists\Components;
use Filament\Infolists;

class HitAndRunResource extends Resource
{
    protected static ?string $model = HitAndRun::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'User';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.hit_and_runs');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('uid')->searchable(),
                Tables\Columns\TextColumn::make('user.username')
                    ->searchable()
                    ->label(__('label.username'))
                    ->formatStateUsing(fn ($record) => new HtmlString(get_username($record->uid, false, true, true, true)))
                ,

                Tables\Columns\TextColumn::make('torrent.name')->limit(30)->label(__('label.torrent.label')),
                Tables\Columns\TextColumn::make('snatch.uploadText')->label(__('label.uploaded')),
                Tables\Columns\TextColumn::make('snatch.downloadText')->label(__('label.downloaded')),
                Tables\Columns\TextColumn::make('snatch.shareRatio')->label(__('label.ratio')),
                Tables\Columns\TextColumn::make('seedTimeRequired')->label(__('label.seed_time_required')),
                Tables\Columns\TextColumn::make('inspectTimeLeft')->label(__('label.inspect_time_left')),
                Tables\Columns\TextColumn::make('statusText')->label(__('label.status')),
                Tables\Columns\TextColumn::make('created_at')->label(__('label.created_at')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\Filter::make('uid')
                    ->form([
                        Forms\Components\TextInput::make('uid')
                            ->label('UID')
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn (Builder $query, $uid) => $query->where("uid", $uid));
                    })
                ,
                Tables\Filters\SelectFilter::make('status')->options(HitAndRun::listStatus(true))->label(__('label.status')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\BulkAction::make('Pardon')->action(function (Collection $records) {
                    $idArr = $records->pluck('id')->toArray();
                    $rep = new HitAndRunRepository();
                    $rep->bulkPardon(['id' => $idArr], Auth::user());
                })
                ->deselectRecordsAfterCompletion()
                ->label(__('admin.resources.hit_and_run.bulk_action_pardon'))
                    ->icon('heroicon-o-x-mark')
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('id'),
                Infolists\Components\TextEntry::make('statusText')
                    ->label(__("label.status"))
                ,
                Infolists\Components\TextEntry::make('uid')
                    ->formatStateUsing(fn ($record) => username_for_admin($record->uid))
                    ->label(__("label.username"))
                ,
                Infolists\Components\TextEntry::make('torrent_id')
                    ->formatStateUsing(fn ($record) => $record->torrent->name)
                    ->label(__("label.torrent.label"))
                ,
                Infolists\Components\TextEntry::make('snatch.uploadedText')
                    ->label(__("label.uploaded"))
                ,
                Infolists\Components\TextEntry::make('snatch.downloadedText')
                    ->label(__("label.downloaded"))
                ,
                Infolists\Components\TextEntry::make('snatch.shareRatio')
                    ->label(__("label.ratio"))
                ,
                Infolists\Components\TextEntry::make('seedTimeRequired')
                    ->label(__("label.seed_time_required"))
                ,
                Infolists\Components\TextEntry::make('inspectTimeLeft')
                    ->label(__("label.inspect_time_left"))
                ,
                Infolists\Components\TextEntry::make('comment')
                    ->formatStateUsing(fn ($record) => nl2br($record->comment))
                    ->label(__("label.comment"))
                ,
                Infolists\Components\TextEntry::make('created_at')
                    ->label(__("label.created_at"))
                ,
                Infolists\Components\TextEntry::make('updated_at')
                    ->label(__("label.updated_at"))
                ,
                ])->columns(4);

    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'torrent', 'snatch', 'torrent.basic_category']);
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
            'index' => Pages\ListHitAndRuns::route('/'),
//            'create' => Pages\CreateHitAndRun::route('/create'),
//            'edit' => Pages\EditHitAndRun::route('/{record}/edit'),
            'view' => Pages\ViewHitAndRun::route('/{record}'),
        ];
    }
}
