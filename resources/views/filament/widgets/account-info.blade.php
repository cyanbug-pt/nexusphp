@php
    $user = filament()->auth()->user();
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <div class="flex items-center gap-x-3">

            <div class="flex-1">
                <h2
                    class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white"
                >
                    {{ __('filament-panels::widgets/account-widget.welcome', ['app' => config('app.name')]) }},
                    {{ filament()->getUserName($user) . '(' . $user->classText . ')' }}
                </h2>

            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
