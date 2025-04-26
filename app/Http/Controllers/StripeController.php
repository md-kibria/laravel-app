<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Service;
use App\Models\OrderItem;
use App\Models\Variation;
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
                's-city' => 'required',
                's-country' => 'required',
                's-email' => 'required',
                's-phone' => 'required',
            ]);
        }

        $settings = SiteSetting::first();

        Stripe::setApiKey($settings->stripe_key);

        // currently this is not using
        if ($request->input('service_id')) {
            $service = Service::findOrFail($request->input('service_id'));
            $total = $service->discounted_price ? $service->price - ($service->price * $service->discounted_price) / 100 : $service->price;

            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'total' => $total,
                // mainPrice
                // method
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
                // price
                // variations => like cart section
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
            $mainTotal = 0;
            return view('pages.checkout', compact('services', 'total', 'mainTotal'));
        }

    
        // Add quantity and price as curr_price to the services
        /* -------------------- */
        function calculatePrice($variations) {
            $price = null;
            $mainPrice = 0;
            $mainQuantity = 0;
            $quantity = 0;
            $fixedDiscount = 0;

            foreach ($variations as $variation) {
                $variationData = Variation::find($variation['id']);
                if($variation['dataType'] == 'text') {
                    $mainPrice = $variationData->price;
                    if($variation['discountType'] == 'percentage') {
                        $price = (int) ($variationData->price * (1 - ((int) ($variationData->discountRule?->value ?? 0) / 100)));
                    } elseif($variation['discountType'] == 'fixed') {
                        $price = (int)$variationData->price - (int)$variationData->discountRule?->value;
                    } else {
                        $price = (int)$variationData->price;
                    }
                } elseif($variation['dataType'] == 'number') {
                    $mainQuantity = (int) $variationData->name;
                    if($variation['discountType'] == 'percentage') {
                        $quantity = $variationData->name * (1 - ((int) ($variationData->discountRule?->value ?? 0) / 100));
                    } elseif($variation['discountType'] == 'fixed') {
                        $quantity = $variationData->name;
                        $fixedDiscount =  (int)$variationData->discountRule?->value;
                    } else {
                        $quantity = (int) $variationData->name;
                        $fixedDiscount =  0;
                    }
                }
            }
            
            if($quantity === 0 && $mainQuantity === 0) {
                return [
                    'price' => $price,
                    'mainPrice' => $mainPrice
                ];
            }

            $totalMainPrice = $mainPrice * $mainQuantity;
            $totalPrice = $price * $quantity;
           
            if($fixedDiscount > 0) {
                $totalPrice = $totalPrice - $fixedDiscount;
            }

            return [
                'price' => $totalPrice,
                'mainPrice' => $totalMainPrice
            ];
        }
        
        $services = [];

        foreach ($cart as $cartItem) {
            $service = Service::find($cartItem['id']);
            $service->quantity = $cartItem['quantity'];
            $service->variations = $cartItem['variations'];
            $service->price = calculatePrice($cartItem['variations']);
            
            $services[] = $service;
        }

        $total = 0;
        $mainTotal = 0;

        foreach ($services as $service) {
            $total += (int) $service->price['price'] * (int)$service->quantity;
            $mainTotal += (int) $service->price['mainPrice'] * (int)$service->quantity;
        }

        /* -------------------- */

        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'total' => $total,
            'mainPrice' => $mainTotal, // this line added
            'status' => 'unpaid',
            'method' => 'stripe',
            'name' => $request->input('s-name') ?? Auth::user()->name,
            'address' => $request->input('s-address'),
            'city' => $request->input('s-city'),
            'country' => $request->input('s-country'),
            'email' => $request->input('s-email') ?? Auth::user()->email,
            'phone' => $request->input('s-phone') ?? Auth::user()->phone,
            'vat' => $request->input('s-vat'),
            'company' => $request->input('s-company'),
            'trade' => $request->input('s-trade'),
            'county' => $request->input('s-county'),
            'nid' => $request->input('s-nid'),
            'type' => $request->input('s-type'),
        ]);
        // Save order items
        foreach ($services as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'service_id' => $item['id'],
                'quantity' => $item['quantity'],
                'variations' => json_encode($item['variations']),
                'price' => json_encode($item['price']),
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
                            url($item['thumbnail'] ?? '')
                        ],
                    ],
                    'unit_amount' => $item['price']['price'] * 100, // Price in cents
                ],
                'quantity' => $item['quantity'],
            ];
        }
        // dd(json_encode($lineItems));
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success', ['order_id' => $order->id, 'type' => 'stripe']) . '&session_id={CHECKOUT_SESSION_ID}',
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
