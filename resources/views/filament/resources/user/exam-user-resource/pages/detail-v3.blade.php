<div class="fi-ta-ctn">
    <div class="fi-ta-content-ctn">
        <table class="fi-ta-table">
            <thead>
            <tr>
                <th class="fi-ta-header-cell fi-ta-header-cell-id">
                    {{ __('label.exam.index_required_label') }}
                </th>
                <th class="fi-ta-header-cell fi-ta-header-cell-id">
                    {{ __('label.exam.index_required_value') }}
                </th>
                <th class="fi-ta-header-cell fi-ta-header-cell-id">
                    {{ __('label.exam.index_current_value') }}

                </th>
                <th class="fi-ta-header-cell fi-ta-header-cell-id">
                    {{ __('label.exam.index_result') }}
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
            @foreach ($getState() as $index)
                <tr class="fi-ta-row">
                    <td class="fi-ta-cell fi-ta-cell-id">
                        <div class="fi-ta-col">
                            <div class="fi-size-sm  fi-ta-text-item  fi-ta-text">{{ $index['index_formatted'] }}</div>
                        </div>
                    </td>
                    <td class="fi-ta-cell fi-ta-cell-id">
                        <div class="fi-ta-col">
                            <div
                                class="fi-size-sm  fi-ta-text-item  fi-ta-text">{{ $index['require_value_formatted'] }}</div>
                        </div>
                    </td>
                    <td class="fi-ta-cell fi-ta-cell-id">
                        <div class="fi-ta-col">
                            <div
                                class="fi-size-sm  fi-ta-text-item  fi-ta-text">{{ $index['current_value_formatted'] }}</div>
                        </div>
                    </td>
                    <td class="fi-ta-cell fi-ta-cell-id">
                        <div class="fi-ta-col">
                            <div class="fi-size-sm  fi-ta-text-item  fi-ta-text">{!! $index['index_result'] !!}</div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
