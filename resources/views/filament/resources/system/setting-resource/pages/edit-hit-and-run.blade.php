<x-filament::page>
    <form wire:submit.prevent="submit" class="fi-sc fi-sc-has-gap fi-grid">
        {{ $this->form }}
        <x-filament::actions>
            <x-filament::button type="submit">
                {{__('filament-actions::edit.single.modal.actions.save.label')}}
            </x-filament::button>
        </x-filament::actions>
    </form>
</x-filament::page>
