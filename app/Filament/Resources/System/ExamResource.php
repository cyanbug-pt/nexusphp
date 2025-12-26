<?php

namespace App\Filament\Resources\System;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\System\ExamResource\Pages\ListExams;
use App\Filament\Resources\System\ExamResource\Pages\CreateExam;
use App\Filament\Resources\System\ExamResource\Pages\EditExam;
use App\Filament\OptionsTrait;
use App\Filament\Resources\System\ExamResource\Pages;
use App\Filament\Resources\System\ExamResource\RelationManagers;
use App\Models\Exam;
use App\Repositories\ExamRepository;
use App\Repositories\UserRepository;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class ExamResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = Exam::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-exclamation-triangle';

    protected static string | \UnitEnum | null $navigationGroup = 'System';

    protected static ?int $navigationSort = 1;

    const IS_DISCOVERED_OPTIONS = ['0' => 'No', '1' => 'Yes'];

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.exams_list');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        $userRep = new UserRepository();
        return $schema
            ->components([
                Section::make(__('label.exam.section_base_info'))->schema([
                    TextInput::make('name')->required()->columnSpan(['sm' => 2])->label(__('label.name')),
                    Select::make('type')
                        ->required()
                        ->columnSpanFull()
                        ->label(__('exam.type'))
                        ->options(Exam::listTypeOptions())
                        ->helperText(__('exam.type_help'))
                        ->reactive()
                    ,
                    TextInput::make('success_reward_bonus')
                        ->columnSpanFull()
                        ->required()
                        ->label(__('exam.success_reward_bonus'))
                        ->hidden(fn (Get $get) => $get('type') != Exam::TYPE_TASK)
                    ,
                    TextInput::make('fail_deduct_bonus')
                        ->columnSpanFull()
                        ->required()
                        ->label(__('exam.fail_deduct_bonus'))
                        ->hidden(fn (Get $get) => $get('type') != Exam::TYPE_TASK)
                    ,
                    TextInput::make('max_user_count')
                        ->columnSpanFull()
                        ->required()
                        ->numeric()
                        ->label(__('exam.max_user_count'))
                        ->hidden(fn (Get $get) => $get('type') != Exam::TYPE_TASK)
                    ,

                    Repeater::make('indexes')->schema([
                        Select::make('index')
                            ->options(Exam::listIndex(true))
                            ->label(__('label.exam.index_required_label'))
                            ->rules([Rule::in(array_keys(Exam::$indexes))])
                            ->required(),
                        TextInput::make('require_value')
                            ->label(__('label.exam.index_required_value'))
                            ->placeholder(__('label.exam.index_placeholder'))
                            ->integer()
                            ->required(),
                        Hidden::make('checked')->default(true),
                    ])
                        ->label(__('label.exam.index_formatted'))
                        ->required(),

                    Radio::make('status')
                        ->options(self::getEnableDisableOptions())
                        ->inline()
                        ->required()
                        ->label(__('label.status'))
                        ->columnSpan(['sm' => 2]),
                    Radio::make('is_discovered')
                        ->options(self::IS_DISCOVERED_OPTIONS)
                        ->label(__('label.exam.is_discovered'))
                        ->inline()
                        ->required()
                        ->columnSpan(['sm' => 2]),
                    TextInput::make('background_color')
                        ->required()
                        ->label(__('exam.background_color'))
                        ->columnSpan(['sm' => 2]),
                    TextInput::make('priority')
                        ->columnSpan(['sm' => 2])
                        ->integer()
                        ->label(__("label.priority"))
                        ->helperText(__('label.exam.priority_help')),
                ])->columns(2),

                Section::make(__('label.exam.section_time'))->schema([
                    DateTimePicker::make('begin')->label(__('label.begin')),
                    DateTimePicker::make('end')->label(__('label.end')),
                    TextInput::make('duration')
                        ->integer()
                        ->columnSpan(['sm' => 2])
                        ->label(__('label.duration'))
                        ->helperText(__('label.exam.duration_help')),
                    Select::make('recurring')
                        ->options(Exam::listRecurringOptions())
                        ->label(__('exam.recurring'))
                        ->helperText(__('exam.recurring_help'))
                        ->columnSpan(['sm' => 2])
                    ,
                ])->columns(2),

                Section::make(__('label.exam.section_target_user'))->schema([
                    CheckboxList::make('filters.classes')
                        ->options($userRep->listClass())->columnSpan(['sm' => 2])
                        ->columns(4)
                        ->label(__('label.user.class')),
                    DateTimePicker::make('filters.register_time_range.0')->label(__("label.exam.register_time_range.begin")),
                    DateTimePicker::make('filters.register_time_range.1')->label(__("label.exam.register_time_range.end")),
                    TextInput::make('filters.register_days_range.0')->numeric()->label(__("label.exam.register_days_range.begin")),
                    TextInput::make('filters.register_days_range.1')->numeric()->label(__("label.exam.register_days_range.end")),
                    CheckboxList::make('filters.donate_status')
                        ->options(self::$yesOrNo)
                        ->label(__('label.exam.donated')),
                ])->columns(2),


                Textarea::make('description')->columnSpan(['sm' => 2])->label(__('label.description')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable()->label(__('label.name')),
                TextColumn::make('typeText')->label(__('exam.type')),
                TextColumn::make('indexFormatted')->label(__('label.exam.index_formatted'))->html(),
                TextColumn::make('begin')->label(__('label.begin')),
                TextColumn::make('end')->label(__('label.end')),
                TextColumn::make('durationText')->label(__('label.duration')),
                TextColumn::make('recurringText')->label(__('exam.recurring')),
                TextColumn::make('filterFormatted')->label(__('label.exam.filter_formatted'))->html()->extraAttributes([]),
                BooleanColumn::make('is_discovered')->label(__('label.exam.is_discovered')),
                TextColumn::make('priority')->label(__('label.priority')),
                TextColumn::make('statusText')->label(__('label.status')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('type')->options(Exam::listTypeOptions())->label(__("exam.type")),
                SelectFilter::make('is_discovered')->options(self::IS_DISCOVERED_OPTIONS)->label(__("label.exam.is_discovered")),
                SelectFilter::make('status')->options(self::getEnableDisableOptions())->label(__("label.status")),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()->using(function ($record) {
                    $rep = new ExamRepository();
                    $rep->delete($record->id);
                }),
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
            'index' => ListExams::route('/'),
            'create' => CreateExam::route('/create'),
            'edit' => EditExam::route('/{record}/edit'),
        ];
    }
}
