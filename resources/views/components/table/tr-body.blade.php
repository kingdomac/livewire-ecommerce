<tr
    {{ $attributes->merge(['class' => 'flex flex-col flex-no wrap hover:bg-gray-100 sm:table-row mb-2.5 sm:mb-0 '], $attributes['class']) }}>
    {{ $slot }}
</tr>
