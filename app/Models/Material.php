<?php

namespace App\Models;

use App\Http\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'Material';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        // 'amount',
        // 'min_amount',
        'name',
        'ei_id',
        'country_id',
        'color_id',
        'type_id',
    ];

    public function color()
    {
        return $this->BelongsTo(Color::class, 'color_id')->withDefault();
    }

    public function country()
    {
        return $this->BelongsTo(Country::class, 'country_id')->withDefault();
    }

    public function ei()
    {
        return $this->BelongsTo(Ei::class, 'ei_id')->withDefault();
    }
    public function type()
    {
        return $this->BelongsTo(MaterialType::class, 'type_id')->withDefault();
    }
    public function category()
    {
        return $this->type->category();
    }



    public function income()
    {
        // return $this->hasMany(PurchaseRow::class, 'mat_id')->orderBy()->limit(10);
        $inc = PurchaseRow::select('date', 'count')->where('mat_id', $this->id)
        ->join('Purchase', 'purch_id', 'Purchase.id')->orderBy('date', 'desc')->limit(10)->get(); 
        return $inc;
    }
    public function expense()
    {

        return $this->hasMany(MatExp::class, 'mat_id')->orderBy('date')->limit(10);

        $inc = MatExp::where('mat_id', $this->id)->orderBy('date')->limit(10);
         return $inc;
    }


    public function amount()
    {
        $date = Utils::dateNow();
        $inc = PurchaseRow::where('mat_id', $this->id)->join('Purchase', 'purch_id', 'Purchase.id')
        ->where('date', '<=', $date)->sum('count');
        $exp = MatExp::where('mat_id', $this->id)->where('date', '<=', $date)->sum('amount');

        return $inc-$exp;

        $bal = MatBal::where('mat_id', $this->id)->get()->last();
        if (!is_null($bal)) {
            return $bal->amount;
        } else {
            return 0;
        }
    }

    public function hasBal()
    {
        $bal = MatBal::where('mat_id', $this->id)->where('date', Utils::timeNow())->get();
        return !is_null($bal);
    }

    public static function add($id, $add, $date)
    {
        $mat = Material::findOrFail($id);

        if (!is_null($mat)) {
            MatBal::add($mat->id, $add, $date);
        }
    }

    public static function sub($id, $ex, $date)
    {
        $mat = Material::findOrFail($id);
        if (!is_null($mat)) {
            MatExp::add($mat->id, $ex, $date);
            MatBal::sub($mat->id, $ex, $date);
        }
    }

    // public static function add($id, $add)
    // {
    //     $mat = Material::findOrFail($id);
    //     if (!is_null($mat)) {
    //         if (is_null($mat->amount)) {
    //             $mat->amount = 0;
    //         }
    //         $mat->amount += $add;
    //         $mat->save();
    //     }
    // }
}
