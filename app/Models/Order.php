<?php

namespace App\Models;

use App\Http\Normalizators\Normalization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $table = '_Order';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'count',
        'countDone',
        'isDone',
        'isUrgent',
        'isHanded',
        'receipt_id',
        'service_id',
    ];

    public function handOver(){
        $this->isHanded = 1;
        $this->save();
    }

    public function service()
    {
        return $this->BelongsTo(Service::class, 'service_id')->withDefault();
    }
    public function receipt()
    {
        return $this->BelongsTo(Receipt::class, 'receipt_id')->withDefault();
    }

    public function handedOverCount() 
    {
        return $this->orderOut->where('isFail', 0)->sum('count');
    }

    public function isHandedOver(){
        $handedOver = $this->handedOverCount();
        return $handedOver == $this->count;
    }

    public function orderOut() {
        return $this->hasMany(OrderOut::class);
    }

    public function receiptClose(){
        $this-> isHanded = 1;
        $this -> isDone = 1;
        $this->countDone = $this->count;
        $this->save();
    }

    public function beauty_date() {
        return Normalization::beautify_date_from_str($this->receipt->dateIn);
    }

    public function isUrgent(){
        if($this->isUrgent){
            return "Срочный";
        }
        return '';
    }


}
