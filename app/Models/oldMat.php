<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'Receipt';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'item',
        'dateIn',
        'cost',
        'dateOut',
        'note',
        'isUrgent',
        'costAdd',
        'costPred',
        'datePlan',
        'isPaid',
        'paidNow',
        'worker_id',
        'customer_id',
    ];

    public function worker()
    {
        return $this->BelongsTo(Worker::class, 'worker_id')->withDefault();
    }
    public function customer()
    {
        return $this->BelongsTo(Customer::class, 'customer_id')->withDefault();
    }

    public function order() {
        return $this->hasOne(Order::class);
    }
    public function income() {
        return $this->hasMany(Income::class);
    }


}
