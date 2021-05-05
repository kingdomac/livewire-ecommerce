<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;

class ProductIndex extends Component
{

    use WithPagination, WithSorting;

    public $show = true;

    // This field to ensure livewire putting sorting params in the url as query string
    protected $queryString = ['sortBy', 'order'];

    public $search = '';



    protected $listeners = [
        'cart.added' => '$refresh',
        'cart.updated' => '$refresh',
        'cart.removed' => '$refresh',
        'cart.item.removed' => '$refresh',
        'cart.destroyed' => '$refresh',
        'products.page.close' => 'close',
        'products.page.open' => 'open'

    ];

    public function open()
    {
        $this->show = true;
        $this->emit('checkout.page.close');
    }

    public function close()
    {
        $this->show = false;
    }

    public function addToBasket($instance, $object, $stock, $qty = 1)
    {
        if ($this->isItemValidForAddToCart($instance, $object)) {
            Cart::instance($instance)->add(new Product($object), $qty, ['stock' => $stock]);
            $this->emitTo('components.header', 'cart.added', $instance);
        }
    }

    public function isItemValidForAddToCart($instance, $object)
    {
        Cart::instance($instance);
        $cartItem = Cart::search(function ($cartItem, $rowId)  use ($object) {
            return $cartItem->id === $object['id'];
        });
        if (!$cartItem->isEmpty()) {
            if ($instance === 'wishlist') {
                return false;
            } else {
                $qty = $cartItem->pluck('qty')[0];
                $stock = (int)$object['quantity'];
                if ($qty < $stock) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return true;
    }



    public function render()
    {
        $search = $this->search;
        $products = Product::when(
            $search,
            function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            }
        )->orderBy($this->sortBy, $this->order)->paginate(12);
        return view('livewire.products.index', ['products' => $products]);
    }
}
