<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'Material';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'amount',
        'name',
        'min_amount',
        'ei_id',
        'country_id',
        'color_id',
        'type_id',
    ];

    public function color()
    {
        return $this->BelongsTo(Color::class, 'color_id')->withDefault();
    }

    public function country()
    {
        return $this->BelongsTo(Country::class, 'country_id')->withDefault();
    }

    public function ei()
    {
        return $this->BelongsTo(Ei::class, 'ei_id')->withDefault();
    }
    public function type()
    {
        return $this->BelongsTo(MaterialType::class, 'type_id')->withDefault();
    }


}
