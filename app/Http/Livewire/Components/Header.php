<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Livewire;

class Header extends Component
{
    public $counters = ['list' => 0, 'wishlist' => 0];

    public $isOpen = false;


    protected $listeners = [
        'cart.added' => 'updateCounter',
        'cart.updated' => 'updateCounter',
        'cart.removed' => 'updateCounter',
        'cart.item.removed' => 'updateCounter',
        'cart.destroyed' => 'updateCounter',
        'close.cart.modal' => 'closeModal',

    ];


    public function mount()
    {

        $this->counters['list'] = Cart::instance('list')->count();
        $this->counters['wishlist'] = Cart::instance('wishlist')->count();
    }

    public function openModal($instance = 'list')
    {

        $this->isOpen = ($this->isOpen == true) ? false : true;
        $this->emit('load.cart.instance', $instance);
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function updateCounter($instance)
    {
        $this->counters[$instance] = Cart::instance($instance)->count();
    }

    public function render()
    {
        Cart::instance('wishlist');
        return view('livewire.components.header');
    }
}
