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
        'price',
        'count',
        'purch_id',
        'mat_id',
        'equip_id',
        'ei_id',
    ];

    public function item(){
        if($this->mat_id == null){
            return $this->hasOne(Equip::class);
        }
        return $this->hasOne(Material::class);
    }

    public function purchase(){
        return $this->hasOne(Purchase::class);
    }

}
