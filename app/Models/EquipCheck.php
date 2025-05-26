<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EquipCheck extends Model
{
    use HasFactory;

    protected $table = 'EquipCheck';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'equip_id',
        'state_id',
    ];

    public function equip(): BelongsTo
    {
        return $this->BelongsTo(Equip::class, 'equip_id')->withDefault();
    }

    public function state(): BelongsTo
    {
        return $this->BelongsTo(State::class, 'state_id');
    }




    public static function storeNewEquip($equip, $date){
        $a = new EquipCheck();
        $a->equip_id = $equip;
        $a->date = $date;
        $a->state_id = 5;
        $a->save();
        
    }

}
