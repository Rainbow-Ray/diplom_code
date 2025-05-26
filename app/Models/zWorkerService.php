<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerService extends Model
{
    use HasFactory;


    protected $table = 'WorkerService';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'worker_id ',
        'service_id ',
    ];


    static function create($workerId, $serviceId){
        $model = new WorkerService();
        $model->worker_id = $workerId;
        $model->service_id = $serviceId;
        $model->save();
    }
}
