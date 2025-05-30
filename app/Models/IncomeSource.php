<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeSource extends Model
{
    use HasFactory;
    protected $table = 'IncomeSource';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];
    
}
