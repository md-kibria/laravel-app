<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Order;
use App\Models\Service;
use App\Models\OrderItem;
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

        if ($request->input('service_id')) {
            $service = Service::findOrFail($request->input('service_id'));
            $total = $service->discounted_price ? $service->price - ($service->price * $service->discounted_price) / 100 : $service->price;

            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'total' => $total,
                'status' => 'unpaid',
                'name' => $request->input('n-name') ?? Auth::user()->name,
                'address' => $request->input('n-address'),
                'email' => $request->input('n-email') ?? Auth::user()->email,
                'phone' => $request->input('n-phone') ?? Auth::user()->phone,
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
            'name' => $request->input('n-name') ?? Auth::user()->name,
            'address' => $request->input('n-address'),
            'email' => $request->input('n-email') ?? Auth::user()->email,
            'phone' => $request->input('n-phone') ?? Auth::user()->phone,
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
