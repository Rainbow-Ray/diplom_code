<?php

namespace App\Models;

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
    ];

    public function source()
    {
        return $this->BelongsTo(IncomeSource::class, 'source_id')->withDefault();
    }
    public function receipt()
    {
        return $this->BelongsTo(Receipt::class, 'receipt_id')->withDefault();
    }

}
