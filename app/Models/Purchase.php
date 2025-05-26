<?php

namespace App\Models;

use App\Http\Normalizators\Normalization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'Purchase';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'number'
    ];

    public function rows(){
        return $this->hasMany(PurchaseRow::class, 'purch_id');
    }
    public static function defNumber() {
        $num = Purchase::all()->last();
        if(is_null($num)){
            return 'з' . 1;
        }
        return 'з'.$num->id+1;
    }

    public function summ(){

        $a = PurchaseRow::where('purch_id', $this->id)->selectRaw('sum(price * PurchaseRow.count) as sum')->get();
        $sum = $a->first()->sum;

        if(is_null($sum)){
            return 0;
        }
        return $sum;
    }


    public function date() {
        return Normalization::beautify_date_from_str($this->date);
    }
}
