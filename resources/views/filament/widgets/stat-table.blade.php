<x-filament-widgets::widget class="fi-ta-ctn fi-ta-ctn-with-header">
    <!-- Header Section -->
    <div class="fi-ta-header">
        <div>
            <h2 class="fi-ta-header-heading">
                {{$header}}
            </h2>
        </div>
    </div>
    <!-- Table Section -->
    <div class="fi-ta-content-ctn">
        <table class="fi-ta-table">
            <tbody>
            @foreach(array_chunk($data, 2) as $chunk)
                <tr>
                    @foreach($chunk as $item)
                        <th class="fi-ta-header-cell fi-ta-header-cell-id">
                            {{$item['text']}}
                        </th>
                        <td class="fi-ta-cell fi-table-cell-id"
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
</x-filament-widgets::widget>
