<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Http\Requests\OrderRequest;
use App\Models\Country;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
            $countries = Country::all();
            return view('order.checkout', ['cart' => $cart, 'countries' => $countries]);
        }
        return redirect()->route('cart.index')->with(['error' => "You can't go to orders, There's no prodcuts in cart"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        }

        if ($request->payment_method == 'cash_on_delivery') {

            $order = Auth::user()->orders()->create([
                "totalPrice" => $request->totalPrice,
                "item_count" => $request->item_count,
            ]);

            $order = Order::find($order->id);

            if ($order) {
                return view('order.confirmation', ['order' => $order, 'address' => $request, 'cart' => $cart])->with(['success' => 'Thank you. Your order has been received']);
            }
        }
    }
}
