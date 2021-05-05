<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class Checkout extends Component
{
    public $show = false;
    public $instance = 'list';

    public $cartItems = [];

    protected $listeners = [
        'checkout.page.open' => 'open',
        'checkout.page.close' => 'close',
        'checkout.page.refresh' => '$refresh'
    ];

    public function open()
    {
        $this->show = true;
        $this->emit('products.page.close');
        $this->emit('close.cart.modal');
    }

    public function close()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
