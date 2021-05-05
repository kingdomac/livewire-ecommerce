<?php

namespace App\Http\Traits;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

trait CartTrait
{


    /**
     * @param $rowId
     */
    public function increaseQuantity($rowId)
    {
        Cart::get();
        $item = Cart::get($rowId);
        $qty = $item->qty + 1;
        Cart::update($rowId, $qty);
        return $qty;
    }

    /**
     * @param $rowId
     */
    public function decreaseQuantity($rowId)
    {
        $item = Cart::get($rowId);
        $qty = $item->qty - 1;
        Cart::update($rowId, $qty);
        return $qty;
    }

    public function destroy($rowId, $message = ['success' => 'Item has been removed'])
    {
        $key = key($message);
        $value = value($message);
        Cart::remove($rowId);
        session()->flash($key, $value);
    }

    public function destroyAll()
    {
        Cart::destroy();
    }
}
