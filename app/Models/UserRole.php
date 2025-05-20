<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'UserRole';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'role_id',
    
    ];


        static function create($user_id, $role_id){
        $model = new UserRole();
        $model->user_id = $user_id;
        $model->role_id = $role_id;
        $model->save();
    }

}
