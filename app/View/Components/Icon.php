<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Icon extends Component
{
    public $src;

    /**
     * Create a new component instance.
     */
    public function __construct($src)
    {
        $this->src = asset("icons/".$src);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icon');
    }
}
