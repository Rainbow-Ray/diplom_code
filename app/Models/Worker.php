<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'Worker';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'surname',
        'name',
        'patronym',
        'dateBirth',
        'passSerie',
        'passNum',
        'datePass',
        'addrPass',
        'addrFact',
        'email',
        'phone',
        'job_id',
    ];
    
    public function job(): BelongsTo
    {
        return $this->BelongsTo(JobTitle::class, 'job_id')->withDefault();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'WorkerService', 'worker_id', 'service_id');
    }

    // public function skills()
    // {
    //     return $this->belongsToMany(Skill::class, 'WorkerSkill', 'worker_id', 'skill_id');
    // }

}
