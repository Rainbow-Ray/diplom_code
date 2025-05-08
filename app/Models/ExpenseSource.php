<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseSource extends Model
{
    use HasFactory;

    protected $table = 'ExpenseSource';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function expenses() {
        return $this->hasMany(Expense::class);
    }


}
