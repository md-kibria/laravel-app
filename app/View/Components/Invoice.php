<?php

namespace App\View\Components;

use Closure;
use App\Models\Order;
use App\Models\SiteSetting;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Invoice extends Component
{
    public $orderId;
    /**
     * Create a new component instance.
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {   
        $settings = SiteSetting::first();
        $order = Order::findOrFail($this->orderId);
        $orderItems = $order->items;

        return view('components.invoice', compact('settings', 'order', 'orderItems'));
    }
}
