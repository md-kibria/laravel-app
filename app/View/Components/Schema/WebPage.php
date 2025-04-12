<?php

namespace App\View\Components\Schema;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WebPage extends Component
{
    public $page;
    public $breadcrumb;
    public $image;

    /**
     * Create a new component instance.
     */
    public function __construct($page = null, $breadcrumb = null, $image = null)
    {
        $this->page = $page;
        $this->breadcrumb = $breadcrumb;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schema.web-page');
    }
}
