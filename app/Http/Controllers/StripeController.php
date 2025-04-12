<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Service;
use App\Models\OrderItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class StripeController extends Controller
{
    // public function index()
    // {
    //     return view('pages.test');
    // }

    public function checkout(Request $request)
    {

        if (!Auth::check()) {
            $request->validate([
                's-name' => 'required',
                's-address' => 'required',
                's-email' => 'required',
                's-phone' => 'required',
            ]);
        }

        $settings = SiteSetting::first();

        Stripe::setApiKey($settings->stripe_key);

        if ($request->input('service_id')) {
            $service = Service::findOrFail($request->input('service_id'));
            $total = $service->discounted_price ? $service->price - ($service->price * $service->discounted_price) / 100 : $service->price;

            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'total' => $total,
                'status' => 'unpaid',
                'name' => $request->input('s-name') ?? Auth::user()->name,
                'address' => $request->input('s-address'),
                'email' => $request->input('s-email') ?? Auth::user()->email,
                'phone' => $request->input('s-phone') ?? Auth::user()->phone,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'service_id' => $service->id,
                'quantity' => 1,
                'price' => $total,
            ]);


            $session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'RON',
                            'product_data' => [
                                'name' => $service->name,
                            ],
                            'unit_amount' => $total * 100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('success', ['order_id' => $order->id]),
                'cancel_url' => route('payment', ['order_id' => $order->id]),
            ]);

            return redirect()->away($session->url);
        }

        $cart = json_decode(Cookie::get('cart', '[]'), true);

        if (!$cart) {
            $services = [];
            $total = 0;
            return view('pages.checkout', compact('services', 'total'));
        }

        // Extract IDs from cart items
        $cartId = array_map(function ($c) {
            return $c['id'];
        }, $cart);

        // Get services based on cart IDs
        $services = Service::whereIn('id', $cartId)->get();

        $total = 0;
        // Add quantity and price as curr_price to the services
        foreach ($services as $service) {
            foreach ($cart as $cartItem) {
                if ($service->id == $cartItem['id']) {
                    $service->quantity = $cartItem['quantity'];
                    $service->curr_price = $cartItem['price'];
                    break;
                }
            }
            $total += (int) $service['curr_price'] * (int)$service['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'total' => $total,
            'status' => 'unpaid',
            'name' => $request->input('s-name') ?? Auth::user()->name,
            'address' => $request->input('s-address'),
            'email' => $request->input('s-email') ?? Auth::user()->email,
            'phone' => $request->input('s-phone') ?? Auth::user()->phone,
        ]);

        // Save order items
        foreach ($services as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'service_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['curr_price'],
            ]);
        }

        $lineItems = [];

        // Assuming you have a $cartItems array with your cart data
        foreach ($services as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'RON',
                    'product_data' => [
                        'name' => $item['name'],
                        // You can also add images, descriptions, etc.
                        'images' => [
                            url($item['thumbnail'])
                        ],
                    ],
                    'unit_amount' => $item['curr_price'] * 100, // Price in cents
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success', ['order_id' => $order->id]),
            'cancel_url' => route('payment', ['order_id' => $order->id]),
        ]);

        return redirect()->away($session->url);
    }

    // public function success(Request $request)
    // {
    //     $orderId = $request->order_id;
    //     $order = Order::findOrFail($orderId);

    //     // Basic verification - you should implement more robust validation
    //     // using Stripe webhooks for production
    //     if ($order->status == 'unpaid') {
    //         // Update order status
    //         $order->update(['status' => 'paid']);

    //         // Clear the cart
    //         // Session::put('cart', []);

    //         session()->flash('success', 'Payment completed successfully! Your order #' . $order->id . ' has been confirmed.');
    //     }

    //     return view('pages.success', compact('order'));
    // }
}
