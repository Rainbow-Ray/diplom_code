<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOut extends Model
{
    use HasFactory;

    protected $table = 'Order out';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'count',
        'note',
        'isFail',
        'order_id',
    ];

    public function order()
    {
        return $this->BelongsTo(Order::class, 'order_id');
    }
}
