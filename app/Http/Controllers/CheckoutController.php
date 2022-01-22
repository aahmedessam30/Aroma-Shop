<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Models\Country;
use PayPal\Api\Transaction;
use App\Models\ProdcutOrder;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
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
        try {
            if (session()->has('cart')) {
                $cart = new Cart(session()->get('cart'));
            }

            if ($request->payment_method == 'cash_on_delivery') {
                $order = $this->cash($request, $cart);
            } else {
                $order = Auth::user()->orders()->create([
                    "totalPrice"      => $request->totalPrice,
                    "item_count"      => $request->item_count,
                    'billing_name'    => $request->name,
                    'billing_email'   => $request->email,
                    'billing_phone'   => $request->phone,
                    'billing_country' => $request->country,
                    'billing_city'    => $request->city,
                    'billing_address' => $request->address,
                    'billing_zip'     => $request->zip,
                    'payment_method'  => 'paypal',
                    'is_paid'         => true,
                    'status'          => 'completed',
                ]);
            }

            foreach ($cart->items as $prodcut) {
                ProdcutOrder::create([
                    'order_id'   => $order->id,
                    'prodcut_id' => $prodcut['id'],
                    'quantity'   => $prodcut['qty'],
                    'total'      => $prodcut['totalPrice'],
                ]);
            }

            if ($order) {
                session()->forget('cart');
                return view('order.confirmation', ['order' => $order]);
            }
        } catch (Exception $e) {
            return view('order.checkout')->with(['error' => 'an error occurred']);
        }
    }

    /**
     * Payment Cash on Delivery
     *
     * @param $request
     * @param $cart
     * @return $order
     */
    public function cash($request, $cart)
    {
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

        return $order;
    }

    /**
     * Call your server to set up the transaction
     *
     */
    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        //Init Paypal
        $provider = \PayPal::setProvider();
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $data['amount']
                    ],
                    "description" => 'Test'
                ]
            ],
        ]);

        return response()->json($order);
    }

    /**
     * Call your server to finalize the transaction
     *
     */
    public function capture(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $orderId = $data['orderId'];

        //Init Paypal
        $provider = \PayPal::setProvider();
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $result = $provider->capturePaymentOrder($orderId);

        return response()->json($result);
    }
}
