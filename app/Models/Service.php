<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'Service';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'cost',
    ];


    public function workers()
    {
        return $this->belongsToMany(Worker::class, 'WorkerService', 'service_id', 'worker_id');
    }
    // public function skills()
    // {
    //     return $this->belongsToMany(Skill::class, 'ServiceSkill', 'service_id', 'skill_id');
    // }

}
