<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    protected $table = 'Equip';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'count',
        'number',
        'type_id',
    ];

    public function equipType(): BelongsTo
    {
        return $this->BelongsTo(EquipType::class, 'type_id')->withDefault();
    }

    public function checks() {
        return $this->belongsToMany(EquipCheck::class, 'EquipCheck', 'equip_id', 'state_id');
    }

    public function state() {

        $lastCheck = EquipCheck::where('equip_id',  $this->id)->get()->last();
        if(!is_null($lastCheck)){
            return $lastCheck->state->name;
        }
        return null;
    }

    



}
