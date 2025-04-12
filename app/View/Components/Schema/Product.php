<?php

namespace App\View\Components\Schema;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Product extends Component
{
    public $product;
    public $reviews;
    /**
     * Create a new component instance.
     */
    public function __construct($product = null, $reviews = null)
    {
        $this->product = $product;
        $this->reviews = $reviews;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schema.product');
    }
}
