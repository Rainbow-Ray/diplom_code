<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class boolSpan extends Component
{
    public $bool;

    /**
     * Create a new component instance.
     */
    public function __construct($cond)
    {
        $this->bool=$cond;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bool-span', ['bool'=>$this->bool]);
    }
}
