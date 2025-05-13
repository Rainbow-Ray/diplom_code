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



}
