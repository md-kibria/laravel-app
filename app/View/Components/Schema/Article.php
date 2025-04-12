<?php

namespace App\View\Components\Schema;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Article extends Component
{
    public $article;
    public $author;
    /**
     * Create a new component instance.
     */
    public function __construct($article = null, $author = null)
    {
        $this->article = $article;
        $this->author = $author ?? [
            'name' => 'Mihai Grasu',
            'url' => url('/'),
            'image' => 'https://secure.gravatar.com/avatar/193312068ef7625a4a7a346721a328fb?s=96&d=mm&r=g',
            'sameAs' => [url('/')]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schema.article');
    }
}
