<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function cart()
    {
        return view('pages.cart');
    }

    public function checkout()
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        if(!$cart) {
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

        return view('pages.checkout', compact('services', 'total'));
    }

    public function payment()
    {
        return view('pages.payment');
    }

    public function success(Request $request)
    {
        $orderId = $request->order_id;
        $order = Order::findOrFail($orderId);

        // Basic verification - you should implement more robust validation
        // using Stripe webhooks for production
        if ($order->status == 'unpaid') {
            // Update order status
            $order->update(['status' => 'paid']);

            // Clear the cart
            Cookie::queue('cart', json_encode([]), 0);

            Mail::to($order->email ?? $order->user->email)->send(new OrderPlacedMail($order));

            session()->flash('success', 'Payment completed successfully! Your order #' . $order->id . ' has been confirmed.');
        }

        return view('pages.success', compact('order'));
    }

    public function orders() {
        $orders = Order::orderBy('id', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function order(Order $order) {
        return view('admin.orders.order', compact('order'));
    }
}
