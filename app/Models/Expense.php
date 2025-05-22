<?php

namespace App\Models;

use App\Http\Normalizators\Normalization;
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
        'orderOut_id',
        'source_id',
    ];

        public function date()
    {
        return Normalization::beautify_date_from_str($this->date);
    }

    public function worker()
    {
        return $this->BelongsTo(Worker::class, 'worker_id')->withDefault();
    }
    public function source()
    {
        return $this->BelongsTo(ExpenseSource::class, 'source_id')->withDefault();
    }
    public function receipt()
    {
        return OrderOut::where('id', $this->orderOut_id)->get()->first()->order()->first()->receipt()->first();
    }
}
