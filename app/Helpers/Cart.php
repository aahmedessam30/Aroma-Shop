<?php

namespace App\Helpers;

class Cart
{
    public $items = [];
    public $totalQty;
    public $totalPrice;

    public function __construct($cart = null)
    {
        if ($cart) {
            $this->items      = $cart->items;
            $this->totalQty   = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        } else {

            $this->items      = [];
            $this->totalQty   = 0;
            $this->totalPrice = 0;
        }
    }

    public function inCart($id)
    {
        if (array_key_exists($id, $this->items)) {
            return true;
        }
    }

    public function add($prodcut)
    {
        $item = [
            'id'           => $prodcut->id,
            'qty'          => 0,
            'name'         => $prodcut->name,
            'slug'         => $prodcut->slug,
            'price'        => $prodcut->price,
            'image'        => $prodcut->image,
            'user_id'      => $prodcut->user_id,
            'brand_id'     => $prodcut->brand_id,
            'availibility' => $prodcut->availibility,
            'description'  => $prodcut->description,
            'category_id'  => $prodcut->category_id,
            'totalPrice'   => $prodcut->price,
        ];

        if (!array_key_exists($prodcut->id, $this->items)) {
            $this->items[$prodcut->id] = $item;
            $this->totalQty += 1;
            $this->totalPrice += $prodcut->price;
        } else {
            $this->totalQty += 1;
            $this->totalPrice += $prodcut->price;
        }

        $this->items[$prodcut->id]['qty'] += 1;
        $this->items[$prodcut->id]['totalPrice'] = $prodcut->price * $this->items[$prodcut->id]['qty'];
    }

    public function remove($id)
    {

        if (array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }

    public function updateQty($id, $qty)
    {

        //reset qty and price in the cart ,
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['qty'];

        // add the item with new qty
        $this->items[$id]['qty'] = $qty;

        // total price and total qty in cart
        $this->totalPrice += $this->items[$id]['price'] * $qty;

        $this->items[$id]['totalPrice'] = $this->items[$id]['price'] * $this->items[$id]['qty'];
    }
}
