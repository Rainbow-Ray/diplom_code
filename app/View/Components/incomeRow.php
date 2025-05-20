<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class incomeRow extends Component
{
    public $income;

    /**
     * Create a new component instance.
     */
    public function __construct($income)
    {
        $this->income=$income;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.income-row', ['income'=>$this->income]);
    }
}
