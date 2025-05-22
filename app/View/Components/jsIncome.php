<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class jsIncome extends Component
{
    public $rootURL = 'income';
    public $item;

    /**
     * Create a new component instance.
     */
    public function __construct($item)
    {
        $this->item=$item;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.js-income', ['item'=>$this->item, 'rootURL'=>$this->rootURL]);
    }
    public function viewRender(): View|Closure|string
    {
        return view('components.js-income', ['item'=>$this->item, 'rootURL'=>$this->rootURL])->render();
    }
}
