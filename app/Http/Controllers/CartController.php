<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Http\Requests\CartRequest;
use App\Models\Prodcut;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = session()->has('cart') ? new Cart(session()->get('cart')) : null;

        return view('cart', ['cart' => $cart]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        $prodcut = Prodcut::find($request->id);

        $cart = session()->has('cart') ? new Cart(session()->get('cart')) : new Cart();

        if ($cart->inCart($prodcut->id)) {
            return response()->json([
                'err' => 'Prodcut already in cart'
            ]);
        }

        $cart->add($prodcut);
        session()->put('cart', $cart);

        return response()->json([
            'msg' => 'Prodcut Added Successfully',
            'count' => $cart->totalQty
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CartRequest $request, Prodcut $prodcut)
    {
        $cart = new Cart(session()->get('cart'));

        $cart->updateQty($prodcut->id, $request->qty);

        session()->put('cart', $cart);

        return response()->json([
            'total'      => $cart->items[$prodcut->id]['totalPrice'],
            'totalprice' => $cart->totalPrice
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodcut $prodcut)
    {
        $cart = new Cart(session()->get('cart'));

        if (!$cart->inCart($prodcut->id)) {
            return response()->json([
                'err' => 'Prodcut not found in cart',
            ]);
        }

        $cart->remove($prodcut->id);

        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return response()->json([
            'msg'   => 'Prodcut Deleted Successfully',
            'id'    => $prodcut->id,
            'count' => $cart->totalQty
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        $cart = new Cart(session()->get('cart'));

        if (!$cart->totalQty > 0) {
            return response()->json([
                'err' => "There's No Prodcuts In cart"
            ]);
        }

        session()->forget('cart');

        return response()->json([
            'msg'   => 'Cart Cleared Successfully',
            'count' => 0
        ]);
    }
}
