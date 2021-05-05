<div>
    <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" x-on:click.away="cartOpen=false"
        class="fixed z-20 right-0 top-0 max-w-lg w-full h-full transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">
        <div wire:loading.remove>
            <div class="flex w-full h-12 px-3 items-center justify-between
             @php
                 echo data_get($themes, "$instance.bgColor");
             @endphp
            ">
                <h3 class="text-2xl font-medium text-gray-200">
                    @php
                        echo data_get($themes, "$instance.title");
                    @endphp
                    @php
                        echo data_get($themes, "$instance.icon-big");
                    @endphp

                </h3>
                <button wire:click="$emitUp('close.cart.modal')"
                    class="text-gray-600 hover:text-white focus:outline-none">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

            </div>
            <hr>
            <div class="px-5">
                <div class="mt-6">
                    @forelse(Cart::content() as $item)
                        <div
                            class="flex justify-between mb-5 px-3 py-3 rounded-lg border border-gray-300 bg-gradient-to-b from-white to-gray-300 shadow-lg">
                            <div class="flex">
                                <div class="mx-3">
                                    <h3 class="text-lg font-bold text-gray-600">{{ $item->name }}</h3>
                                    <div class="flex text-gray-600 font-semibold">{{ $item->price }}$</div>
                                    <div>
                                        @if ($instance === 'list')
                                            <div class="flex items-center mt-2">
                                                <button
                                                    wire:click.prevent="decreaseQuantity('{{ $instance }}', '{{ $item->rowId }}')"
                                                    class="
                                                    @if ($item->qty == 1) ?
                                                    invisible @endif
                                                    text-gray-500 focus:outline-none focus:text-gray-600">
                                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </button>
                                                <span class="text-gray-700 mx-2">{{ $item->qty }}</span>
                                                <button
                                                    wire:click.prevent="increaseQuantity('{{ $instance }}', '{{ $item->rowId }}')"
                                                    class="
                                                    @if ($item->qty == $item->options->stock) ? invisible @endif
                                                    text-gray-500 focus:outline-none focus:text-gray-600">
                                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0
                                                        24 24" stroke="currentColor">
                                                        <path
                                                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </button>

                                            </div>
                                            @if ($item->qty > 1)
                                                <div class="mt-2 text-sm font-semibold text-gray-600">
                                                    <span class="font-bold text-sm">Subtotal:</span>
                                                    ${{ $item->price * $item->qty }}
                                                </div>
                                            @endif
                                            <div class="mt-2 text-sm font-semibold text-gray-600">
                                                <span class="italic font-bold text-sm">Tax Rate:</span>
                                                {{ $item->taxRate }}
                                            </div>
                                            <div class="mt-4 text-lg font-semibold underline text-gray-600">
                                                <span class="font-bold text-lg">Total:</span>
                                                {{ $item->total }} USD
                                            </div>
                                        @endif
                                    </div>


                                </div>
                            </div>

                            <div class="flex justify-end mt-2">
                                <button wire:click="destroy('{{ $instance }}', '{{ $item->rowId }}')"
                                    title="remove item from cart" class="
                                @php
                                    echo data_get($themes, "$instance.bgColor");
                                @endphp
                                rounded-lg shadow-md px-3 py-1 text-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>

                        </div>
                    @empty
                        <div>
                            Card is Empty!
                            <a wire:click="$emitUp('close.cart.modal')"
                                class="cursor-pointer no-underline hover:underline">
                                Go to The Store
                            </a>
                        </div>
                    @endforelse
                </div>
                @if (Cart::instance($instance)->count() > 1 && $instance === 'list')
                    <div class="mt-2 text-lg font-bold text-gray-600">
                        Subtotal: <span
                            class="font-semibold text-sm">${{ Cart::instance($instance)->subtotal() }}</span>
                    </div>
                    <div class="mt-2 text-lg font-bold text-gray-600">
                        Tax: <span class="font-semibold text-sm">{{ Cart::instance($instance)->tax() }}</span>
                    </div>
                    <div class="mt-2 text-xl font-bold underline text-gray-600">
                        Total: <span class="font-semibold text-lg">{{ Cart::instance($instance)->total() }}
                            USD</span>
                    </div>

                @endif
                @if (Cart::instance($instance)->count() > 0 && $instance === 'list')
                    <a href="#" wire:click="$emit('checkout.page.open')"
                        class="flex items-center justify-center mt-4 px-3 py-2 bg-green-500 text-white text-sm uppercase font-medium rounded hover:bg-green-600 focus:outline-none focus:bg-green-700">
                        <span>Chechout</span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                @endif
                @if (Cart::instance($instance)->count() > 1)
                    <a href="#" wire:click.prevent="destroyAll('{{ $instance }}')"
                        class="flex items-center justify-center mt-4 px-3 py-2 bg-red-700 text-white text-sm uppercase font-medium rounded hover:bg-red-900 focus:outline-none focus:bg-red-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span class="ml-2">Clear All</span>

                    </a>
                @endif

            </div>

        </div>
    </div>

</div>
