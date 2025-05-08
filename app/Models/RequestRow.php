<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestRow extends Model
{
    use HasFactory;

    protected $table = 'RequestRow';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'count',
        'countPurchased',
        'name',
        'req_id',
        'mat_id',
        'equip_id',
        'ei_id',
    ];

    public function get_id_with_prefix() {
        if($this->mat_id != null){
            return 'M'.$this->mat_id;
        }
        elseif( $this->equip_id != null)
        {
            return 'F'.$this->equip_id;
        }
            return 'I'.$this->name;
    }

    public function item(){
        if($this->mat_id != null){
            return Material::findOrFail($this->mat_id)->name;
        }
        elseif( $this->equip_id != null)
        {
            return Equip::findOrFail($this->equip_id)->name;
        }
            return $this->name;

    }

    public function request(){
        return $this->BelongsTo(Request::class, 'req_id')->withDefault();
    }
    public function ei(){
        return $this->BelongsTo(Ei::class)->withDefault();
    }

    public function print(){
        echo 'count:'.
        $this->count
        .' name:'.
        $this->item()
        .' req_id:'.
        $this->req_id
        .' mat_id:'.
        $this->mat_id 
        .' equip_id:'.
        $this->equip_id 
        .' ei_id:'.
        $this->ei_id;

    }
}
