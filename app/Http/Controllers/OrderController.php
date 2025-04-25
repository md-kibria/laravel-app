<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\Http;
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

        // Check if cart is empty    
        if (!$cart) {
            $services = [];
            $total = 0;
            $mainTotal = 0;
            return view('pages.checkout', compact('services', 'total', 'mainTotal'));
        }

        function calculatePrice($variations)
        {
            $price = null;
            $mainPrice = 0;
            $mainQuantity = 0;
            $quantity = 0;
            $fixedDiscount = 0;

            foreach ($variations as $variation) {
                $variationData = Variation::find($variation['id']);
                if ($variation['dataType'] == 'text') {
                    $mainPrice = $variationData->price;
                    if ($variation['discountType'] == 'percentage') {
                        $price = (int) ($variationData->price * (1 - ((int) ($variationData->discountRule?->value ?? 0) / 100)));
                    } elseif ($variation['discountType'] == 'fixed') {
                        $price = (int)$variationData->price - (int)$variationData->discountRule?->value;
                    } else {
                        $price = (int)$variationData->price;
                    }
                } elseif ($variation['dataType'] == 'number') {
                    $mainQuantity = (int) $variationData->name;
                    if ($variation['discountType'] == 'percentage') {
                        $quantity = $variationData->name * (1 - ((int) ($variationData->discountRule?->value ?? 0) / 100));
                    } elseif ($variation['discountType'] == 'fixed') {
                        $quantity = $variationData->name;
                        $fixedDiscount =  (int)$variationData->discountRule?->value;
                    } else {
                        $quantity = (int) $variationData->name;
                        $fixedDiscount =  0;
                    }
                }
            }

            if ($quantity === 0 && $mainQuantity === 0) {
                return [
                    'price' => $price,
                    'mainPrice' => $mainPrice
                ];
            }

            $totalMainPrice = $mainPrice * $mainQuantity;
            $totalPrice = $price * $quantity;

            if ($fixedDiscount > 0) {
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

        return view('pages.checkout', compact('services', 'total', 'mainTotal'));
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
            
            $client = [
                "name" => $order->name,
                "address" => $order->address,
                "city" => $order->city,
                "county" => $order->county,
                "country" => $order->country,
                "email" => $order->email,
                "phone" => $order->phone,
                "saveToDb" => true
            ];

            if($order->vat) {
                $client['vatCode'] = $order->vat;
            }
            
            $items = [];

            foreach ($order->items as $item) {
                $itemData = [
                    "code" => (string)$item->id,
                    "name" => $item->service->name,
                    "measuringUnitName" => "buc",
                    "currency" => "RON",
                    "quantity" => $item->quantity,
                    "price" => json_decode($item->price)->price,
                    // "isTaxIncluded" => true,
                    // "taxPercentage" => 0,
                    "saveToDb" => false
                ];

                $items[] = $itemData;
            }
            
            // Clear the cart
            Cookie::queue('cart', json_encode([]), 0);

            // Create invoice
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode(env('SMARTBILL_API_EMAIL') . ':' . env('SMARTBILL_API_TOKEN')),
                'Content-Type' => 'application/json'
            ])->withOptions([
                'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
            ])->post('https://ws.smartbill.ro/SBORO/api/invoice', [
                "companyVatCode" => env('SMARTBILL_COMPANY_VAT'),
                "seriesName" => "RCON",
                "client" => $client,
                "issueDate" => $order->created_at,
                "products" => $items
            ]);
           
            if ($response->successful()) {
                $res = $response->json(); // The invoice details
                $order->update([
                    'series' => $res['series'],
                    'number' => $res['number']
                ]);
            }

            Mail::to($order->email ?? $order->user?->email)->send(new OrderPlacedMail($order));

            session()->flash('success', 'Payment completed successfully! Your order #' . $order->id . ' has been confirmed.');
        }

        return view('pages.success', compact('order'));
    }

    public function orders()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function order(Order $order)
    {
        return view('admin.orders.order', compact('order'));
    }
}
