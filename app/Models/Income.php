<?php

namespace App\Models;

use App\Http\Normalizators\Normalization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $table = 'Income';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'number',
        'amount',
        'date',
        'source_id',
        'receipt_id',
        'service_id',
    ];

    public function source()
    {
        return $this->BelongsTo(IncomeSource::class, 'source_id')->withDefault();
    }
    public function receipt()
    {
        return $this->BelongsTo(Receipt::class, 'receipt_id')->withDefault();
    }

    public function service()
    {
        return $this->BelongsTo(FastService::class, 'service_id')->withDefault();
    }

    public function date() {
        return Normalization::beautify_dateTime($this->date);
    }

    

}
