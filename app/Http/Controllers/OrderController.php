<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Http\Requests\OrderRequest;
use App\Models\Country;
use App\Models\Order;
use App\Models\ProdcutOrder;
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
            $countries = Country::orderBy('name')->get();
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
                "totalPrice"      => $request->totalPrice,
                "item_count"      => $request->item_count,
                'billing_name'    => $request->name,
                'billing_email'   => $request->email,
                'billing_phone'   => $request->phone,
                'billing_country' => $request->country,
                'billing_city'    => $request->city,
                'billing_address' => $request->address,
                'billing_zip'     => $request->zip
            ]);

            foreach ($cart->items as $prodcut) {
                ProdcutOrder::create([
                    'order_id'   => $order->id,
                    'prodcut_id' => $prodcut['id'],
                    'quantity'   => $prodcut['qty'],
                    'total'      => $prodcut['totalPrice'],
                ]);
            }

            if ($order) {
                return view('order.confirmation', ['order' => $order])->with(['success' => 'Thank you. Your order has been received']);
            }
        }
    }
}
