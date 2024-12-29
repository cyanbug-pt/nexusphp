<x-filament-widgets::widget class="fi-wi-table">
    <div class="filament-widgets-card rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm p-6">
        <!-- Header Section -->
        <div class="fi-ta-header flex flex-col gap-3 p-4 sm:px-6 sm:flex-row sm:items-center">
            <div class="grid gap-y-1">
                <h3 class="fi-ta-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    {{ $header }}
                </h3>
            </div>
        </div>

        <!-- Table Section -->
        <div class="fi-ta-content border-t relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
            <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                @foreach(array_chunk($data, 2) as $chunk)
                    <tr class="bg-white dark:bg-gray-800">
                        @foreach($chunk as $item)
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-id">
                                {{$item['text']}}
                            </th>
                            <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-id"
                                @if($loop->count == 1)
                                    colspan="3"
                                @endif
                            >
                                <div class="{{$item['class'] ?? ''}}">{{$item['value']}}</div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-filament-widgets::widget>
