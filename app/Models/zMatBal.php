<?php

namespace App\Models;

use App\Http\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatBal extends Model
{
    use HasFactory;
    protected $table = 'MatBal';
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

    public static function add($mat_id, $add, $date)
    {
        $bal = MatBal::where('mat_id', $mat_id)->where('date', $date)->get()->last();
        $balStart = MatBal::where('mat_id', $mat_id)->where('date', '<', $date)->get()->last();
        $lastAmount = 0;
        if (!is_null($balStart)) {
            $lastAmount = $balStart->amount;
        }
        if (is_null($bal)) {
            $bal = MatBal::create($mat_id, $lastAmount, $date);
        }
        $bal->amount += $add;
        $bal->save();
    }

    public static function sub($mat_id, $ex, $date)
    {
        $bal = MatBal::where('mat_id', $mat_id)->where('date', $date)->get()->last();
        $balStart = MatBal::where('mat_id', $mat_id)->where('date', '<', $date)->get()->last();
        $lastAmount = 0;
        if (!is_null($balStart)) {
            $lastAmount = $balStart->amount;
        }
        if (is_null($bal)) {
            $bal = MatBal::create($mat_id, $lastAmount, $date);
        }
        $bal->amount -= $ex;
        $bal->save();
    }

    public static function create($mat_id, $amount,  $date)
    {
        $bal = new MatBal();
        $bal->date = $date;
        $bal->mat_id = $mat_id;
        $bal->amount = $amount;
        $bal->save();
        return $bal;
    }
}
