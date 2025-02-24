<div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
    <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
        <thead class="divide-y divide-gray-200 dark:divide-white/5">
        <tr class="bg-gray-50 dark:bg-white/5">
            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-id">
                <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                    <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                        {{ __('label.exam.index_required_label') }}
                    </span>
                </span>
            </th>
            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-id">
                <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                    <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                        {{ __('label.exam.index_required_value') }}
                    </span>
                </span>
            </th>
            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-id">
                <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                    <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                        {{ __('label.exam.index_current_value') }}
                    </span>
                </span>
            </th>
            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-id">
                <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                    <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                        {{ __('label.exam.index_result') }}
                    </span>
                </span>
            </th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
        @foreach ($getState() as $index)
            <tr class="dark:bg-gray-800">
                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-id">{{ $index['index_formatted'] }}</td>
                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-id">{{ $index['require_value_formatted'] }}</td>
                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-id">{{ $index['current_value_formatted'] }}</td>
                <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-id">{!! $index['index_result'] !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
