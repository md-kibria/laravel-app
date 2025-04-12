<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AddToCart extends Component
{
    public $service;

    public function mount($service)
    {
        $this->service = $service;
    }

    // public function addToCart()
    // {
    //     $cart = Session::get('cart', []);

    //     $exists = false;

    //     foreach ($cart as &$item) {
    //         if ($item['id'] === $this->service->id) {
    //             $item['quantity'] += 1; // Increase quantity
    //             $exists = true;
    //             break;
    //         }
    //     }

    //     if (!$exists) {
    //         // Add new item to cart
    //         $cart[] = [
    //             'id' => $this->service->id,
    //             'name' => $this->service->name,
    //             'price' => $this->service->discounted_price 
    //                 ? $this->service->price - ($this->service->price * $this->service->discounted_price) / 100 
    //                 : $this->service->price,
    //             'thumbnail' => $this->service->thumbnail,
    //             'quantity' => 1,
    //         ];
    //     }

    //     Session::put('cart', $cart);

    //     // Notify the cart component to update
    //     $this->dispatch('cartUpdated');
    //     $this->dispatch('cartCountUpdated', count($cart)); // Add this line
    // }

    // New system with cookie
    public function addToCart()
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        $exists = false;

        foreach ($cart as &$item) {
            if ($item['id'] === $this->service->id) {
                $item['quantity'] += 1;
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            $cart[] = [
                'id' => $this->service->id,
                'name' => $this->service->name,
                'price' => $this->service->discounted_price
                    ? $this->service->price - ($this->service->price * $this->service->discounted_price) / 100
                    : $this->service->price,
                'thumbnail' => $this->service->thumbnail,
                'quantity' => 1,
            ];
        }

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 7); // Store for 7 days

        $this->dispatch('cartUpdated');
        $this->dispatch('cartCountUpdated', count($cart));
    }


    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
