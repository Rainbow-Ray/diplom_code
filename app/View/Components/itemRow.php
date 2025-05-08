<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class itemRow extends Component
{
    public $item;
    public $name;
    public $prefix;
    public $id;
    private static $idName = 1;
    public $value;
    public $isPurchased = false;

    /**
     * Create a new component instance.
     */
    public function __construct($item, $purchased)
    {
        $this->item=$item;
        $this->name = $item->item();

        $this->isPurchased = $purchased;

        if($item->mat_id !=null){
            $this->prefix = 'M';
            $this->id = $item->mat_id;

            $this->value = $this->prefix.$this->id;
        }
        else if($item->equip_id !=null){
            $this->prefix = 'F';
            $this->id = $item->equip_id;
            $this->value = $this->prefix.$this->id;

        }
        else{
            $this->prefix = 'I';
            $this->id =  $this::$idName;
            $this::$idName+=1;
            $this->value = $this->prefix.$this->name;

        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-row', ['item'=>$this->item,
        'name'=>$this->name,
        'prefix'=>$this->prefix,
        'id'=>$this->id,
        'value'=>$this->id,
        'isPurchased' => $this->isPurchased,
    ]);
    }
}
