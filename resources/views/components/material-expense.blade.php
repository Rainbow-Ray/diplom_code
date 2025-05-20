@if (count($items) > 1)
    @for ($i = 0; $i < count($items) - 1; $i++)
        @if ($i == 0)
            <x-exp-start :item="$items[$i]" />
            <x-exp-row :item="$items[$i]" />
        @else
            @if ($items[$i]->date != $items[$i - 1]->date)
                <x-exp-end />
                <x-exp-start :item="$items[$i]" />
                <x-exp-row :item="$items[$i]" />
            @endif

            @if ($items[$i]->date == $items[$i - 1]->date)
                <x-exp-row :item="$items[$i]" />
            @endif
        @endif
    @endfor

    @if ($items[count($items) - 1]->date != $items[count($items) - 1 - 1]->date)
        <x-exp-end />
        <x-exp-start :item="$items[count($items) - 1]" />
        <x-exp-row :item="$items[count($items) - 1]" />
        <x-exp-end />
    @else

            <x-exp-row :item="$items[count($items) - 1]" />
            <x-exp-end />
    @endif
@else
    @if (count($items) == 1)
        <x-exp-start :item="$items[0]" />
        <x-exp-row :item="$items[0]" />
        <x-exp-end />
    @endif
@endif


