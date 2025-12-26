<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AccountInfo extends Widget
{
    protected string $view = 'filament.widgets.account-info';

    protected int | string | array $columnSpan = 'full';
}
