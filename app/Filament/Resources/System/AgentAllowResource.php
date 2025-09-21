<?php

namespace App\Filament\Resources\System;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\System\AgentAllowResource\RelationManagers\DeniesRelationManager;
use App\Filament\Resources\System\AgentAllowResource\Pages\ListAgentAllows;
use App\Filament\Resources\System\AgentAllowResource\Pages\CreateAgentAllow;
use App\Filament\Resources\System\AgentAllowResource\Pages\EditAgentAllow;
use App\Filament\OptionsTrait;
use App\Filament\Resources\System\AgentAllowResource\Pages;
use App\Filament\Resources\System\AgentAllowResource\RelationManagers;
use App\Models\AgentAllow;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgentAllowResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = AgentAllow::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-check';

    protected static string | \UnitEnum | null $navigationGroup = 'System';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.agent_allows');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('family')->required()->label(__('label.agent_allow.family')),
                TextInput::make('start_name')->required()->label(__('label.agent_allow.start_name')),
                TextInput::make('peer_id_start')->required()->label(__('label.agent_allow.peer_id_start')),
                TextInput::make('peer_id_pattern')->required()->label(__('label.agent_allow.peer_id_pattern')),
                Radio::make('peer_id_matchtype')->options(self::$matchTypes)->required()->label(__('label.agent_allow.peer_id_matchtype')),
                TextInput::make('peer_id_match_num')->integer()->required()->label(__('label.agent_allow.peer_id_match_num')),
                TextInput::make('agent_start')->required()->label(__('label.agent_allow.agent_start')),
                TextInput::make('agent_pattern')->required()->label(__('label.agent_allow.agent_pattern')),
                Radio::make('agent_matchtype')->options(self::$matchTypes)->required()->label(__('label.agent_allow.agent_matchtype')),
                TextInput::make('agent_match_num')->required()->label(__('label.agent_allow.agent_match_num')),
                Radio::make('exception')->options(self::$yesOrNo)->required()->label(__('label.agent_allow.exception')),
                Radio::make('allowhttps')->options(self::$yesOrNo)->required()->label(__('label.agent_allow.allowhttps')),

                Textarea::make('comment')->label(__('label.comment')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('family')->searchable()->label(__('label.agent_allow.family')),
                TextColumn::make('start_name')->searchable()->label(__('label.agent_allow.start_name')),
                TextColumn::make('peer_id_start')->label(__('label.agent_allow.peer_id_start')),
                TextColumn::make('agent_start')->label(__('label.agent_allow.agent_start')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()->using(function ($record) {
                    $record->delete();
                    clear_agent_allow_deny_cache();
                    return redirect(self::getUrl());
                })
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DeniesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAgentAllows::route('/'),
            'create' => CreateAgentAllow::route('/create'),
            'edit' => EditAgentAllow::route('/{record}/edit'),
        ];
    }
}
