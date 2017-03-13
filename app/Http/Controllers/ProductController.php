<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Order;
use Session;
use Stripe\Stripe;
use Stripe\Charge;
use Auth;

class ProductController extends Controller {

    public function getIndex() {
        $products = Product::all();
        return view('shope.index', ['products' => $products]);
    }

    public function getAddToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        return redirect()->route('product.index')->with(['success' => $product->title . ' added successfully']);
    }

    public function getReduceOne($id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceOne($id);
        if (count($cart->items)) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingcart');
    }

    public function getReduceAll($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceAll($id);
        if (count($cart->items)) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingcart');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shope.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shope.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('shope.shopping-cart', ['products' => null]);
        }
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);
        $totalprice = $cart->totalPrice;
        return view('shope.checkout', ['total' => $totalprice]);
    }

    public function postCheckout(Request $request) {
        if (!Session::has('cart')) {
            return redirect()->route('product.shoppingcart');
        }
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);
        Stripe::setApiKey('sk_test_z2vcSB9tFAPrCPgRCAtBVQXN');
        try {
            $charge = Charge::create([
                        "amount" => $cart->totalPrice * 100,
                        "currency" => "usd",
                        "source" => $request['stripeToken'], // obtained with Stripe.js
                        "description" => "Charge for ..."
            ]);
            $order = new Order();
            $order->cart = serialize($cart);
            $order->adresse = $request['adresse'];
            $order->name = $request['name'];
            $order->payment_id = $charge->id;
            $order->user_id = Auth::user()->orders()->save($order);
        } catch (Exception $e) {
            return redirect()->route('checkout')->with(['error' => $e->message()]);
        }
        Session::forget('cart');
        return redirect()->route('product.index')->with(['success' => 'Successfully checkouted']);
    }

}
