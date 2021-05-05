<?php

namespace App\Http\Livewire;

use Faker\Core\Number;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    public $cartItems = [];

    public $instance;

    public $counters;

    public $themes = [
        "list" => [
            "title" => "Shopping Cart",
            "bgColor" => "bg-green-500",
            "color" => "color-green-500",
            "icon-big" => "<i class='fas fa-shopping-cart'></i>"
        ],
        'wishlist' => [
            "title" => 'Wish List',
            "bgColor" => "bg-red-500",
            "color" => "color-red-500",
            "icon-big" => "<i class='fas fa-heart'></i>"
        ]
    ];


    protected $listeners = [
        'load.cart.instance' => 'loadInstance',

    ];



    public function loadInstance($instance = 'list')
    {
        $this->reset();
        $this->instance = $instance;
        Cart::instance($instance);
        $this->cartItems =  Cart::instance($instance)->content();
    }

    public function increaseQuantity($instance, $rowId)
    {

        Cart::instance($instance);
        $item = Cart::get($rowId);
        $stock = (int)$item->options->stock;
        $qty = $item->qty + 1;
        if ($qty <= $stock) {
            Cart::update($rowId, $qty);
            $this->emit('cart.updated', $instance);
            $this->emit('checkout.page.refresh');
        }
    }

    /**
     * @param $rowId
     */
    public function decreaseQuantity($instance, $rowId)
    {
        Cart::instance($instance);
        $item = Cart::get($rowId);
        $qty = $item->qty - 1;
        Cart::update($rowId, $qty);
        $this->emit('cart.updated', $instance);
        $this->emit('checkout.page.refresh');
    }

    public function destroy($instance, $rowId)
    {
        Cart::instance($instance);
        Cart::remove($rowId);
        session()->flash('success_message', 'Item has been removed');
        $this->emit('cart.item.removed', $instance);
        $this->emit('checkout.page.refresh');
    }

    public function destroyAll($instance)
    {
        Cart::instance($instance);
        Cart::destroy();
        $this->emit('cart.destroyed', $instance);
        $this->emit('products.page.open');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
