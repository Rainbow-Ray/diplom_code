<?php

namespace App\Models;

use App\Http\Normalizators\Normalization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'Receipt';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'number',
        'item',
        'dateIn',
        'cost',
        'dateOut',
        'note',
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

    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function income()
    {
        return $this->hasMany(Income::class);
    }

    public function dateIn()
    {
        return Normalization::beautify_date_from_str($this->dateIn);
    }
    public function dateOut()
    {
        return Normalization::beautify_date_from_str($this->dateOut);
    }
    public function datePlan()
    {
        return Normalization::beautify_date_from_str($this->datePlan);
    }

    public static function defNumber()
    {
        $num = Purchase::all()->last();
        if (is_null($num)) {
            return 0;
        }
        return $num->id + 1;
    }
}
