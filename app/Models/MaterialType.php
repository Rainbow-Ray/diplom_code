<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;
    protected $table = 'MaterialType';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'cat_id',
    ];

    public function category()
    {
        return $this->belongsTo(MaterialCat::class, 'cat_id')->withDefault();
    }
    
}
