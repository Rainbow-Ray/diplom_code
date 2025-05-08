<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerSkill extends Model
{
    use HasFactory;


    protected $table = 'WorkerSkill';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'worker_id ',
        'skill_id ',
    ];


    static function create($workerId, $skillId){
        $model = new WorkerSkill();
        $model->worker_id = $workerId;
        $model->skill_id = $skillId;
        $model->save();
    }
}
