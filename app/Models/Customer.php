<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'Customer';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $attributes = [
        'discount' => '0',
    ];

    protected $fillable = [
        'surname',
        'name',
        'patronym',
        'phone',
        'discount',
    ];
}
