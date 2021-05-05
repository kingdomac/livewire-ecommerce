<div>
    @if ($show)
        <div>
            <div class="flex px-5 py-5 justify-between sm:text-xl
                text-black-500 shadow-lg bg-gradient-to-b from-green-50 to-green-300
                border border-gray-200">
                <div><i class="far fa-credit-card"></i> Your Order</div>
                <div>
                    <button wire:click="$emit('products.page.open')" title="Back to Store">
                        <i class="fas fa-store"></i> <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
            </div>
            <div class="mt-5 md:flex md:space-x-3">
                @forelse(Cart::instance($instance)->content() as $item)
                    <div
                        class="mb-3 md:mb-0 px-3 py-3 flex-grow md:min-w-1/3 rounded-lg border border-gray-300 bg-gradient-to-b from-white to-gray-300 shadow-lg">
                        <h3 class="sm:text-sm md:text-lg font-bold text-gray-600">{{ $item->name }}</h3>
                        <div class="flex text-gray-600 font-semibold">{{ $item->price }}$</div>
                        <div>
                            @if ($instance === 'list')
                                <div class="mt-2 font-semibold text-gray-600">
                                    <span class="font-bold text-sm">Quantity:</span>
                                    {{ $item->qty }}
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
                                <div class="mt-4 text-base font-semibold underline text-gray-600">
                                    <span class="font-bold text-base">Total:</span>
                                    {{ $item->total }} USD
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div>
                        Card is Empty!
                        <a wire:click="$emit('products.page.open')" class="cursor-pointer no-underline hover:underline">
                            <button wire:click="$emit('products.page.open')" title="Back to Store">
                                <i class="fas fa-store"></i> Back to Store <i class="fas fa-arrow-left"></i>
                            </button>
                        </a>
                    </div>
                @endforelse
            </div>
        </div>


        @if (Cart::instance($instance)->count() > 1)
            <div class="text-red-500">
                <div class="mt-2 text-lg font-bold ">
                    Subtotal: <span
                        class="font-semibold text-sm text-gray-600">${{ Cart::instance($instance)->subtotal() }}</span>
                </div>
                <div class="mt-2 text-lg font-bold">
                    Tax:
                    <span class=" font-semibold text-sm text-gray-600">
                        {{ Cart::instance($instance)->tax() }}
                    </span>
                </div>
                <div class="mt-2 text-xl font-bold">
                    Total: <span class="font-semibold text-lg text-gray-600">{{ Cart::instance($instance)->total() }}
                        USD</span>
                </div>
            </div>
        @endif

    @endif
</div>
