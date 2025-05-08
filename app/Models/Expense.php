<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'Expense';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'amount',
        'date',
        'worker_id',
        'source_id',
    ];

    public function worker()
    {
        return $this->BelongsTo(Worker::class, 'worker_id')->withDefault();
    }
    public function source()
    {
        return $this->BelongsTo(ExpenseSource::class, 'source_id')->withDefault();
    }
}
