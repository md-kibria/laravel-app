<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AddToCart extends Component
{
    public $service;
    public $quantity = 1;
    public $selectedVariations = [];
    public $calculatedPrice = 0;

    public function mount($service, $quantity = 1)
    {
        $this->service = $service;
        $this->quantity = $quantity;
    }

    // New system with cookie
    // public function addToCart()
    // {
    //     $cart = json_decode(Cookie::get('cart', '[]'), true);

    //     $exists = false;

    //     foreach ($cart as &$item) {
    //         if ($item['id'] === $this->service->id) {
    //             $item['quantity'] += $this->quantity;
    //             $exists = true;
    //             break;
    //         }
    //     }

    //     if (!$exists) {
    //         $cart[] = [
    //             'id' => $this->service->id,
    //             'name' => $this->service->name,
    //             'price' => $this->service->discounted_price
    //                 ? $this->service->price - ($this->service->price * $this->service->discounted_price) / 100
    //                 : $this->service->price,
    //             'thumbnail' => $this->service->thumbnail,
    //             'quantity' => $this->quantity,
    //         ];
    //     }

    //     Cookie::queue('cart', json_encode($cart), 60 * 24 * 7); // Store for 7 days

    //     $this->dispatch('cartUpdated');
    //     $this->dispatch('cartCountUpdated', count($cart));
    // }

    public function updateQuantity($newQuantity)
    {
        $this->quantity = $newQuantity;
    }

    // public function addToCartWithQuantity($quantity)
    // {
    //     $this->quantity = (int) $quantity;
    //     $this->addToCart();
    // }

    public function addToCartWithVariations($selectedVariations, $quantity = 1)
    {
        $variationIds = collect($selectedVariations)->pluck('id')->sort()->values()->all();
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        $exists = false;

        foreach ($cart as &$item) {
            if (
                $item['id'] === $this->service->id &&
                isset($item['variation_ids']) &&
                $item['variation_ids'] === $variationIds
            ) {
                $item['quantity'] += $quantity;
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            // Calculate base price (e.g., area * num of session)
            $area = collect($selectedVariations)->firstWhere('type', 'area');
            $session = collect($selectedVariations)->firstWhere('type', 'number of session');

            $price = 0;
            // if ($area && $session) {
            //     $price = $area['price'] * (int) $session['name']; // assuming name is like "1", "3", etc.
            // } else {
            //     $price = collect($selectedVariations)->sum('price'); // fallback
            // }

            foreach ($selectedVariations as $value) {
                if($price == 0) {
                    $price = $value['price'];
                } else {
                    $price *= $value['price'];
                }
            }

            $cart[] = [
                'cart_id' => (string)$this->service->id . implode('', $variationIds),
                'id' => $this->service->id,
                'slug' => $this->service->slug,
                'name' => $this->service->name,
                'thumbnail' => $this->service->thumbnail,
                'quantity' => $quantity,
                'price' => $price,
                'variation_ids' => $variationIds,
                'variations' => $selectedVariations,
            ];
        }

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 7);
        $this->dispatch('cartUpdated');
        $this->dispatch('cartCountUpdated', count($cart));
    }


    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
