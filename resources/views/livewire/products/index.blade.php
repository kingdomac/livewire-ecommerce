<div x-data="{ cartOpen: false , isOpen: false }" class="bg-white">
    @if ($show)
        <div class="flex justify-end items-center mt-20">
            <div>
                <x-ui.search wire:model='search' />
            </div>
        </div>


        <div wire:loading.class.delay="opacity-50" class="flex-col justify-center items-center pt-5 text-left">

            <x-table>
                <x-slot name="head">
                    @forelse ($products as $product)
                        <x-table.tr-head wire:key="prodHead{{ $product->id }}">
                            <x-table.th sortable wire:click="sortBy('id')" :direction="$sortBy === 'id' ? $order : null"
                                class="cursor-pointer">
                                #ID
                            </x-table.th>
                            <x-table.th sortable wire:click="sortBy('name')"
                                :direction="$sortBy === 'name' ? $order : null" class="cursor-pointer">Name
                            </x-table.th>
                            <x-table.th sortable wire:click="sortBy('price')"
                                :direction="$sortBy === 'price' ? $order : null" class="cursor-pointer">
                                Price
                            </x-table.th>
                            <x-table.th sortable wire:click="sortBy('quantity')"
                                :direction="$sortBy === 'quantity' ? $order : null" class="cursor-pointer w-4/12">
                                Stock
                            </x-table.th>
                            <x-table.th>Action</x-table.th>
                        </x-table.tr-head>
                    @empty
                        <x-table.tr-head>
                            <x-table.th>#</x-table.th>
                            <x-table.th>Name</x-table.th>
                            <x-table.th>Price</x-table.th>
                            <x-table.th>Quantity</x-table.th>
                            <x-table.th>Action</x-table.th>
                        </x-table.tr-head>
                    @endforelse
                </x-slot>
                <x-slot name="body">
                    @forelse ($products as $product)
                        <x-table.tr-body wire:key="prodBody{{ $product->id }}" wire:loading.class.delay="opacity-50">
                            <x-table.td>{{ $product->id }}</x-table.td>
                            <x-table.td class="line-clamp-1">{{ $product->name }}</x-table.td>
                            <x-table.td>{{ $product->price }}</x-table.td>
                            <x-table.td>{{ $product->quantity }}</x-table.td>
                            <x-table.td>
                                <div class="flex justify-left text-sm items-center space-x-2">
                                    @if ($this->isItemValidForAddToCart('list', $product))
                                        <div>
                                            <button
                                                wire:click.prevent="addToBasket('list', {{ $product }}, '{{ $product->quantity }}')"
                                                title="Add to Cart" class="px-2 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endif

                                    <div>
                                        @if ($this->isItemValidForAddToCart('wishlist', $product))
                                            <button
                                                wire:click.prevent="addToBasket('wishlist', {{ $product }}, '{{ $product->quantity }}')"
                                                title="Add to Wishlist" class="px-2 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </button>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6 mx-2 my-1 text-red-500" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>

                                </div>
                            </x-table.td>
                        </x-table.tr-body>
                    @empty
                        <x-table.tr-body>
                            <x-table.td colspan="5">
                                <div class="flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-50" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <span class="py-5 ml-2 sm:text-sm md:text-lg text-gray-400">

                                        Sorry! We are not able to provide a matching product at this time.
                                    </span>

                                </div>
                            </x-table.td>
                        </x-table.tr-body>
                    @endforelse
                </x-slot>
            </x-table>
            <div class="pt-5">{{ $products->links() }}</div>
        </div>
    @endif

    <livewire:checkout />


</div>
