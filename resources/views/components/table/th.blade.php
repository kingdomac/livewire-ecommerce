<th {{ $attributes->merge(['class' => 'p-3 text-left '], $attributes['class']) }}>
    <div class="flex">
        <span>{{ $slot }}</span>
        @if ($attributes['sortable'])
            <span class="ml-2">
                @if ($attributes['direction'] === 'desc')
                    <i class="fas fa-sort-amount-down-alt cursor-pointer opacity-30 hover:opacity-100"></i>
                @elseif($attributes['direction'] === 'asc')
                    <i class="fas fa-sort-amount-up-alt cursor-pointer opacity-30 hover:opacity-100"></i>
                @endif

            </span>

        @endif

    </div>



</th>
