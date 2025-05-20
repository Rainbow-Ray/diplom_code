<?php

namespace App\Models;

use App\Http\Normalizators\Normalization;
use App\Http\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatExp extends Model
{
    use HasFactory;
    protected $table = 'MatExp';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'amount',
        'mat_id',
    ];

    public function material()
    {
        return $this->BelongsTo(Material::class, 'mat_id')->withDefault();
    }
    public function date()
    {
        return Normalization::beautify_date_from_str($this->date);
    }

    public static function add($mat_id, $ex, $date){
        $exp = MatExp::where('mat_id', $mat_id)->where('date',  $date)->get()->last();
        if (is_null($exp)) {
            $exp = new MatExp();
            $exp->date =  $date;
            $exp->mat_id = $mat_id;
            $exp->amount = $ex;
            $exp->save();
        }
        else{
            $exp->amount += $ex;
            $exp->save();
        }

    }
}
