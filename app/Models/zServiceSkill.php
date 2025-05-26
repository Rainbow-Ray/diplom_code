<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSkill extends Model
{
    use HasFactory;


    protected $table = 'ServiceSkill';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'service_id ',
        'skill_id ',
    ];

    static function create($serviceId, $skillId){
        $model = new ServiceSkill();
        $model->service_id = $serviceId;
        $model->skill_id = $skillId;
        $model->save();
    }

    

}
