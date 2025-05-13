<?php

namespace App\View\Components;

use App\Http\Utils\Utils;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class period extends Component
{
    public $now;
    public $prevMonth;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->now = Utils::formatDate(Utils::timeNow(), 'Y-m-d') ;
        $this->prevMonth = Utils::formatDate(Utils::dateSubMonth(1), 'Y-m-d');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.period', ['now'=>$this->now, 'prevMonth' => $this->prevMonth]);
    }
}
