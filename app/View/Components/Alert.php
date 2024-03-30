<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Alert extends Component
{
    public $type;
    public $dismissible;
//    public $id;
    protected $types = [
        "success",
        "warning",
        "danger",
        "info",
    ];

    public function validType()
    {
        return in_array($this->type, $this->types) ? $this->type : $this->types[3];
    }

    /**
     * Create a new component instance.
     */
    public function __construct($type = "info" /* ,$id*/, $dismissible = false)
    {
        $this->type = $type;
        $this->dismissible = $dismissible;
//        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
