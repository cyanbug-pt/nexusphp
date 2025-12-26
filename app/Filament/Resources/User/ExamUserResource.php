<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\User\ExamUserResource\Pages\ListExamUsers;
use App\Filament\Resources\User\ExamUserResource\Pages\ViewExamUser;
use App\Filament\Resources\User\ExamUserResource\Pages;
use App\Filament\Resources\User\ExamUserResource\RelationManagers;
use App\Models\Exam;
use App\Models\ExamUser;
use App\Repositories\ExamRepository;
use App\Repositories\HitAndRunRepository;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Infolists\Components\ViewEntry;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Filament\Infolists;
use Filament\Infolists\Components;

class ExamUserResource extends Resource
{
    protected static ?string $model = ExamUser::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shield-check';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.exam_users');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('uid')->searchable(),
                TextColumn::make('user.username')
                    ->label(__('label.username'))
                    ->searchable()
                    ->formatStateUsing(fn ($record) => new HtmlString(get_username($record->uid, false, true, true, true)))
                ,
                TextColumn::make('exam.name')->label(__('label.exam.label')),
                TextColumn::make('exam.typeText')->label(__('exam.type')),
                TextColumn::make('begin')->label(__('label.begin'))->dateTime(),
                TextColumn::make('end')->label(__('label.end'))->dateTime(),
                BooleanColumn::make('is_done')->label(__('label.exam_user.is_done')),
                TextColumn::make('statusText')->label(__('label.status')),
                TextColumn::make('created_at')->dateTime()->label(__('label.created_at')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('uid')
                    ->schema([
                        TextInput::make('uid')
                            ->label('UID')
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn (Builder $query, $uid) => $query->where("uid", $uid));
                    })
                ,
                SelectFilter::make('exam_type')
                    ->options(Exam::listTypeOptions())
                    ->label(__('exam.type'))
                    ->query(function (Builder $query, array $data) {
                        $query->when($data['value'], function (Builder $query) use ($data) {
                            $query->whereHas("exam", function (Builder $query) use ($data) {
                                $query->where("type", $data['value']);
                            });
                        });
                    })
                ,
                SelectFilter::make('exam_id')
                    ->options(Exam::query()->pluck('name', 'id')->toArray())
                    ->label(__('label.exam.label'))
                ,
                SelectFilter::make('status')->options(ExamUser::listStatus(true))->label(__("label.status")),
                SelectFilter::make('is_done')->options(['0' => 'No', '1' => 'yes'])->label(__('label.exam_user.is_done')),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->groupedBulkActions([
                BulkAction::make('Avoid')->action(function (Collection $records) {
                    $idArr = $records->pluck('id')->toArray();
                    $rep = new ExamRepository();
                    $rep->avoidExamUserBulk(['id' => $idArr], Auth::user());
                })
                ->deselectRecordsAfterCompletion()
                ->requiresConfirmation()
                ->label(__('admin.resources.exam_user.bulk_action_avoid_label'))
                ->icon('heroicon-o-x-mark'),

                BulkAction::make('UpdateEnd')
                    ->form([
                        DateTimePicker::make('end')
                            ->required()
                            ->label(__('label.end'))
                        ,
                        Textarea::make('reason')
                            ->label(__('label.reason'))
                        ,
                    ])
                    ->action(function (Collection $records, array $data) {
                        $end = Carbon::parse($data['end']);
                        $rep = new ExamRepository();
                        foreach ($records as $record) {
                            if ($end->isAfter($record->begin)) {
                                $rep->updateExamUserEnd($record, $end, $data['reason'] ?? '');
                            } else {
                                do_log(sprintf("examUser: %d end: %s is before begin: %s, skip", $record->id, $end, $record->begin));
                            }
                        }
                    })
                    ->deselectRecordsAfterCompletion()
                    ->label(__('admin.resources.exam_user.bulk_action_update_end_label'))
                    ->icon('heroicon-o-pencil'),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    Group::make([
                        TextEntry::make('id'),
                        TextEntry::make('statusText')
                            ->label(__("label.status"))
                        ,
                        TextEntry::make('uid')
                            ->formatStateUsing(fn ($record) => username_for_admin($record->uid))
                            ->label(__("label.username"))
                        ,
                        TextEntry::make('exam.name')
//                    ->formatStateUsing(fn ($record) => $record->torrent->name)
                            ->label(__("label.exam.label"))
                        ,
                        TextEntry::make('begin')
                            ->label(__("label.begin"))
                        ,
                        TextEntry::make('end')
                            ->label(__("label.end"))
                        ,
                        TextEntry::make('isDoneText')
                            ->label(__("label.exam_user.is_done"))
                        ,
                        TextEntry::make('created_at')
                            ->label(__("label.created_at"))
                        ,
                        TextEntry::make('updated_at')
                            ->label(__("label.updated_at"))
                        ,
                    ])
                        ->columnSpan(1)
                        ->columns(2)
                    ,
                    Group::make([
                        ViewEntry::make('progressFormatted')
                            ->label('进度')
                            ->view('filament.resources.user.exam-user-resource.pages.detail-v3')
                        ])->columnSpan(1),
                ]),
            ]);

    }

//    private static function buildProgressTable(): array
//    {
//        $exam = $record->exam;
//        $passTransKey = $exam->getPassResultTransKey('pass');
//        $notPassTransKey = $exam->getPassResultTransKey('not_pass');
//        $result = [];
//        $result[] = Components\Grid::make(4) // 4 列的网格
//        ->schema([
//            Infolists\Components\TextEntry::make('index')->label(__('label.exam.index_required_label')),
//            Infolists\Components\TextEntry::make('require')->label(__('label.exam.index_required_value')),
//            Infolists\Components\TextEntry::make('current')->label(__('label.exam.index_current_value')),
//            Infolists\Components\TextEntry::make('result')->label(__('label.exam.index_result')),
//        ]);
//        foreach($record->progressFormatted as $key => $index) {
//            $result[] =  Components\Grid::make(4) // 4 列的网格
//            ->schema([
//                Infolists\Components\TextEntry::make('index'.$key)->label($index['index_formatted']),
//                Infolists\Components\TextEntry::make('require'.$key)->label($index['require_value_formatted']),
//                Infolists\Components\TextEntry::make('current'.$key)->label($index['current_value_formatted']),
//                Infolists\Components\TextEntry::make('result'.$key)->label($index['passed'] ? __($passTransKey) : __($notPassTransKey)),
//            ]);
//        }
//
//
//        return $result;
//    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'exam']);
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
            'index' => ListExamUsers::route('/'),
//            'create' => Pages\CreateExamUser::route('/create'),
//            'edit' => Pages\EditExamUser::route('/{record}/edit'),
            'view' => ViewExamUser::route('/{record}'),
        ];
    }
}
