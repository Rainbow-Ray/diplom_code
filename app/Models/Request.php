<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $table = 'Request';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'dateCreated',
        'dateClosed',
        'isUrgent',
        'isDone',
        'worker_id',
    ];

    public function rows(){
        return $this->hasMany(RequestRow::class,'req_id');
    }
    public function worker(){
        return $this->belongsTo(Worker::class)->withDefault();
    }

}
