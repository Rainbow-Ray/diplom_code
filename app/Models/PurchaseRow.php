<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRow extends Model
{
    use HasFactory;

    protected $table = 'PurchaseRow';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'count',
        'purch_id',
        'mat_id',
        'equip_id',
        'ei_id',
    ];

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
    public function category(){
        if($this->mat_id != null){
            return Material::findOrFail($this->mat_id)->type->name;
        }
        elseif( $this->equip_id != null)
        {
            return Equip::findOrFail($this->equip_id)->equipType->name;
        }
            return '';
    }



    public function purchase(){
        return $this->belongsTo(Purchase::class, 'purch_id')->withDefault();
    }

    public function ei(){
        return $this->BelongsTo(Ei::class)->withDefault();
    }


}
