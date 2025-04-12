<?php

namespace App\View\Components;

use App\Models\HomepageContent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class KeyFeatures extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $key_features = HomepageContent::where('type', 'key_features')->get();

        return view('components.key-features', compact('key_features'));
    }
}
