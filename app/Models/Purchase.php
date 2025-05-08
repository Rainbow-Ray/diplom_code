<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'Purchase';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
    ];

    public function rows(){
        return $this->hasMany(PurchaseRow::class);

    }
}
