<?php

namespace App\Models;

use App\Http\Normalizators\Normalization;
use App\Http\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastService extends Model
{
    use HasFactory;

    protected $table = 'FastService';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'number',
        'count',
        'service_id',
        'income_id',
    ];

    public function service() {
        return $this->belongsTo(Service::class)->withDefault();
    }
    public function income() {
        return $this->belongsTo(Income::class)->withDefault();
    }
    public function date() {
        return Normalization::beautify_date_from_str($this->date);
    }

    public static function  getNumber() {

        if(is_null(FastService::orderBy('date')->get()->last())){
            return 1;
        }

        return FastService::orderBy('date')->get()->last()->id + 1;
    }


}
