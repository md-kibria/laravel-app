<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Order;
use App\Models\Service;
use App\Models\OrderItem;
use App\Models\Variation;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class NetopiaController extends Controller
{

    protected $apiKey;
    protected $signature;
    protected $url = 'https://secure.sandbox.netopia-payments.com/payment/card/start';

    public function __construct()
    {
        $settings = SiteSetting::first();

        $this->apiKey = $settings->netopia_key;
        $this->signature = $settings->netopia_signature;
    }

    public function checkout(Request $request)
    {

        if (!Auth::check()) {
            $request->validate([
                'n-name' => 'required',
                'n-address' => 'required',
                'n-city' => 'required',
                'n-country' => 'required',
                'n-email' => 'required',
                'n-phone' => 'required',
            ]);
        }

        $request->validate([
            'cc-name' => 'required',
            'cc-number' => 'required',
            'cc-expiration' => ['required', 'regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/'],
            'cc-cvv' => 'required',
        ]);

        $date = $request->input('cc-expiration');
        $dateTime = DateTime::createFromFormat('m/y', $date);

        $month = $dateTime->format('n'); // 'n' gives month without leading zeros
        $year = $dateTime->format('Y'); // Full 4-digit year

        // this is not using
        if ($request->input('service_id')) {
            $service = Service::findOrFail($request->input('service_id'));
            $total = $service->discounted_price ? $service->price - ($service->price * $service->discounted_price) / 100 : $service->price;

            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'total' => $total,
                'status' => 'unpaid',
                'name' => $request->input('n-name') ?? Auth::user()->name,
                'address' => $request->input('n-address'),
                'city' => $request->input('s-city'),
                'country' => $request->input('s-country'),
                'email' => $request->input('n-email') ?? Auth::user()->email,
                'phone' => $request->input('n-phone') ?? Auth::user()->phone,
                'vat' => $request->input('s-vat'),
                'company' => $request->input('s-company'),
                'trade' => $request->input('s-trade'),
                'county' => $request->input('s-county'),
                'nid' => $request->input('s-nid'),
                'type' => $request->input('s-type'),
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'service_id' => $service->id,
                'quantity' => 1,
                'price' => $total,
            ]);

            $response = Http::withHeaders([
                'Authorization' => $this->apiKey,
                'Content-Type' => 'application/json'
            ])->withOptions([
                'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
            ])->post($this->url, [
                'config' => [
                    'notifyUrl' => route('success', ['order_id' => $order->id]),
                    'redirectUrl' => route('payment', ['order_id' => $order->id]),
                    'language' => session()->get('lang')
                ],
                'payment' => [
                    'options' => ['installments' => 1],
                    'instrument' => [
                        'type' => 'card',
                        'account' => $request->input('cc-number'),
                        'expMonth' => (int)$month,
                        'expYear' => (int)$year,
                        'secretCode' => $request->input('cc-cvv')
                    ]
                ],
                'order' => [
                    'posSignature' => $this->signature,
                    'dateTime' => '2023-08-24T14:15:22Z',
                    'description' => 'Reshape Clinique Payment',
                    'orderID' => '#' . $order->id,
                    'amount' => $total,
                    'currency' => 'RON',
                    'billing' => [
                        'email' => Auth::check() ? Auth::user()->email : $request->input('email'),
                        'phone' => Auth::check() ? Auth::user()->phone : $request->input('phone'),
                        'firstName' => $request->input('cc-name'),
                        'city' => Auth::check() ? Auth::user()->city . ', ' . Auth::user()->country : $request->input('address'),
                        'details' => ''
                    ]
                ]
            ]);

            $res = json_decode($response->body());

            if ($res->error->code == "00") {
                return redirect()->route('success', ['order_id' => $order->id]);
            } elseif ($res->error->code == "50") {
                return redirect()->route('success', ['order_id' => $order->id, 'msg' => $res->error->message]);
            } else {
                return redirect()->route('payment', ['order_id' => $order->id])->with('error', $res->details->message);
            }
        }


        // CART

        $cart = json_decode(Cookie::get('cart', '[]'), true);

        if (!$cart) {
            $services = [];
            $total = 0;
            $mainTotal = 0;
            return view('pages.checkout', compact('services', 'total', 'mainTotal'));
        }

        // Get services based on cart IDs
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

        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'total' => $total,
            'mainPrice' => $mainTotal, // this line added
            'status' => 'unpaid',
            'method' => 'netopia',
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
                'variations' => json_encode($item['variations']),
                'price' => json_encode($item['price']),
            ]);
        }

        $response = Http::withHeaders([
            'Authorization' => $this->apiKey,
            'Content-Type' => 'application/json'
        ])->withOptions([
            'verify' => base_path('/public/storage/cacert.pem') // Make sure the file exists here
        ])->post($this->url, [
            'config' => [
                'notifyUrl' => route('success', ['order_id' => $order->id]),
                'redirectUrl' => route('payment', ['order_id' => $order->id]),
                'language' => session()->get('lang')
            ],
            'payment' => [
                'options' => ['installments' => 1],
                'instrument' => [
                    'type' => 'card',
                    'account' => $request->input('cc-number'),
                    'expMonth' => (int)$month,
                    'expYear' => (int)$year,
                    'secretCode' => $request->input('cc-cvv')
                ]
            ],
            'order' => [
                'posSignature' => $this->signature,
                'dateTime' => $order->create_at,
                'description' => 'Reshape Clinique Payment',
                'orderID' => '#' . $order->id,
                'amount' => $total,
                'currency' => 'RON',
                'billing' => [
                    'email' => Auth::check() ? Auth::user()->email : $request->input('email'),
                    'phone' => Auth::check() ? Auth::user()->phone : $request->input('phone'),
                    'firstName' => $request->input('cc-name'),
                    'city' => Auth::check() ? Auth::user()->city . ', ' . Auth::user()->country : $request->input('address'),
                    'details' => ''
                ]
            ]
        ]);

        $res = json_decode($response->body());

        if ($res->error->code == "00") {
            return redirect()->route('success', ['order_id' => $order->id]);
        } elseif ($res->error->code == "50") {
            return redirect()->route('success', ['order_id' => $order->id, 'msg' => $res->error->message]);
        } else {
            return redirect()->route('payment', ['order_id' => $order->id])->with('error', $res->error->message);
        }
    }

    public function confirm()
    {
        return 'Payment confirm';
    }

    public function return()
    {
        return 'Payment return';
    }
}
