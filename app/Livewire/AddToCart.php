<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AddToCart extends Component
{
    public $service;
    public $quantity = 1;

    public function mount($service, $quantity = 1)
    {
        $this->service = $service;
        $this->quantity = $quantity;
    }

    // New system with cookie
    public function addToCart()
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        $exists = false;

        foreach ($cart as &$item) {
            if ($item['id'] === $this->service->id) {
                $item['quantity'] += $this->quantity;
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
                'quantity' => $this->quantity,
            ];
        }

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 7); // Store for 7 days

        $this->dispatch('cartUpdated');
        $this->dispatch('cartCountUpdated', count($cart));
    }

    public function updateQuantity($newQuantity)
    {
        $this->quantity = $newQuantity;
    }

    public function addToCartWithQuantity($quantity)
{
    $this->quantity = (int) $quantity;
    $this->addToCart();
}

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
