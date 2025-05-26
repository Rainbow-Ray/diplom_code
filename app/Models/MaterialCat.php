<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCat extends Model
{
    use HasFactory;
    protected $table = 'MaterialCat';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function materials()
    {
        return $this->hasMany(Material::class)->withDefault();
    }
}
