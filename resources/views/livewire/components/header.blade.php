<div x-data="{ cartOpen: @entangle('isOpen')  }">
    <div>
        <!-- Begin Sidebar-->
        @livewire('cart-component')
        <!-- end Sidebar -->
    </div>
    <div class="flex relative justify-end mb-10">
        <div class="flex justify-end fixed z-10">
            @if ($counters['wishlist'])
                <div class="mr-4">
                    <button wire:loading.class.delay='opacity-30' wire:target="openModal('wishlist')"
                        wire:click="openModal('wishlist')" class="relative" title="Add to Wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        @if ($counters['wishlist'])
                            <span
                                class="absolute right-4 -top-3 rounded-full bg-red-500 text-white text-xs px-2 py-1  leading-tight text-center">
                                {{ $counters['wishlist'] }}
                            </span>
                        @endif
                    </button>
                </div>
            @endif
            @if ($counters['list'])
                <div>
                    <button wire:loading.class.delay='opacity-30' wire:target="openModal('list')"
                        wire:click="openModal('list')" class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if ($counters['list'])
                            <span
                                class="absolute -right-3 -top-3 rounded-full bg-green-500 text-white text-xs px-2 py-1  leading-tight text-center">
                                {{ $counters['list'] }}
                            </span>

                        @endif
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
