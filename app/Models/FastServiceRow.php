<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastServiceRow extends Model
{
    use HasFactory;

    protected $table = 'FastServiceRow';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        '',
        'service_id',
    ];

    public function service() {
        return $this->belongsTo(FastService::class)->withDefault();
    }

    public function material() {
        return $this->belongsTo(MatExp::class)->withDefault();
    }


}
