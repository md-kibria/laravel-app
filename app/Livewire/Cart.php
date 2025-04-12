<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class Cart extends Component
{
    public $cart = [];

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    // public function loadCart()
    // {
    //     $this->cart = Session::get('cart', []);
    // }

    // New system with cookie
    public function loadCart()
    {
        $this->cart = json_decode(Cookie::get('cart', '[]'), true);
    }

    // public function removeFromCart($index)
    // {
    //     $cart = Session::get('cart', []);

    //     if (isset($cart[$index])) {
    //         unset($cart[$index]);
    //         Session::put('cart', array_values($cart)); // Re-index array
    //     }

    //     $this->loadCart(); // Refresh cart items
    //     $this->dispatch('cartCountUpdated', count($cart)); // Add this line
    // }

    // public function increaseQuantity($id)
    // {
    //     $cart = Session::get('cart', []);

    //     foreach ($cart as &$item) {
    //         if ($item['id'] === $id) {
    //             $item['quantity'] += 1; // Increase quantity
    //             break;
    //         }
    //     }

    //     Session::put('cart', $cart);
    //     $this->dispatch('cartUpdated'); // Notify the cart component
    //     $this->dispatch('modalStayOpen');
    //     $this->dispatch('cartCountUpdated', count($cart)); // Add this line
    // }

    // public function decreaseQuantity($id)
    // {
    //     $cart = Session::get('cart', []);

    //     foreach ($cart as &$item) {
    //         if ($item['id'] === $id) {
    //             if ($item['quantity'] > 1) {
    //                 $item['quantity'] -= 1; // Decrease quantity
    //             } else {
    //                 // Remove item if quantity is 1
    //                 $cart = array_filter($cart, fn($i) => $i['id'] !== $id);
    //             }
    //             break;
    //         }
    //     }

    //     Session::put('cart', array_values($cart)); // Reset indexes
    //     $this->dispatch('cartUpdated'); // Notify the cart component
    //     $this->dispatch('openModal');
    //     $this->dispatch('cartCountUpdated', count($cart)); // Add this line
    // }

    // With cookie
    public function removeFromCart($index)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Re-index array
            Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // Store for 30 days
        }

        $this->loadCart(); // Refresh cart items
        $this->dispatch('cartUpdated');
        $this->dispatch('cartCountUpdated', count($cart));
    }

    public function increaseQuantity($id)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        foreach ($cart as &$item) {
            if ($item['id'] === $id) {
                $item['quantity'] += 1; // Increase quantity
                break;
            }
        }

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);
        $this->dispatch('cartUpdated');
        $this->dispatch('modalStayOpen');
        $this->dispatch('cartCountUpdated', count($cart));
    }

    public function decreaseQuantity($id)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        foreach ($cart as &$item) {
            if ($item['id'] === $id) {
                if ($item['quantity'] > 1) {
                    $item['quantity'] -= 1; // Decrease quantity
                } else {
                    // Remove item if quantity is 1
                    $cart = array_filter($cart, fn($i) => $i['id'] !== $id);
                }
                break;
            }
        }

        Cookie::queue('cart', json_encode(array_values($cart)), 60 * 24 * 30); // Reset indexes and store
        $this->dispatch('cartUpdated');
        $this->dispatch('openModal');
        $this->dispatch('cartCountUpdated', count($cart));
    }


    public function render()
    {
        // Get all cart items from db
        return view('livewire.cart');
    }
}
