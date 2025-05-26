<?php

namespace App\Models;

use App\Http\Normalizators\Normalization;
use App\Http\Utils\Utils;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Equip extends Model
{
    use HasFactory;

    protected $table = 'Equip';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'count',
        'number',
        'checkFreq',
        'type_id',
    ];
    public $replace = false;


    public static function add($id, $add){
        $eq = Equip::findOrFail($id);
        if(!is_null($eq)){
            if(is_null($eq->count)){
                $eq->count = 0;
            }
            $eq->count += $add;
            $eq->save();
        }
    }

    public function equipType(): BelongsTo
    {
        return $this->BelongsTo(EquipType::class, 'type_id')->withDefault();
    }

    public function checks() {
        return $this->belongsToMany(EquipCheck::class, 'EquipCheck', 'equip_id', 'state_id');
    }

    public function state() {

        $lastCheck = EquipCheck::where('equip_id',  $this->id)->get()->last();
        if(!is_null($lastCheck)){
            return $lastCheck->state->name;
        }
        return null;
    }
    public function dateCheck() {

        $lastCheck = EquipCheck::where('equip_id',  $this->id)->orderBy('date')->get()->last();
        if(!is_null($lastCheck)){
            return Normalization::beautify_date_from_str( $lastCheck->date);
        }
        return null;
    }
    public function date() {

        $lastCheck = EquipCheck::where('equip_id',  $this->id)->orderBy('date')->get()->last();
        if(!is_null($lastCheck)){
            return Normalization::beautify_date_from_str( $lastCheck->date);
        }
        return null;
    }
    public function states() {

        return EquipCheck::where('equip_id',  $this->id)->orderBy('date')->get();
    }
    public function getState() {

        return EquipCheck::where('equip_id',  $this->id)->orderBy('date')->get()->last();
    }

    public function needReplace(){
        $state = $this->getState();

        if(is_null($state)){
            return false;
        }

        $state = $this->getState()->state;


        if(!is_null($state) && $state->state < 3){
            return true;
        }
        return false;
    }
    public function old(){
        $check = $this->getState();

        if(!is_null($check) && $this->monthOld($check->date)){
            return true;
        }
        return false;
    }

    public function monthOld($a)  {

        $a = new DateTime($a);
        $now = Utils::timeNow();
        $time = $now->diff($a);

        if($time->days > $this->checkFreq){
            return true;
        }
        return false;
        
    }


    public static function getNeedReplace()  {
        $equips = Equip::all();

        $arr = array();
        foreach ($equips as $e) {
            if($e->needReplace() || $e->old()){
                $arr[] = $e;
            }
        }
        return $arr;
    }





}
