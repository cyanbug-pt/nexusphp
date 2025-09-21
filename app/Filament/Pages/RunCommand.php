<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class RunCommand extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.run-command';
    protected static bool $shouldRegisterNavigation = false;

}
