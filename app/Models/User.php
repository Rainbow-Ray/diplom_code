<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role_id',
        'email',
        'password',
        'worker_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getRoles(){
        return $this->belongsToMany(Role::class, 'UserRole', 'user_id', 'role_id');
         
    }
    public function roles(){
        $arr = array();
        $roles = $this->getRoles;
        foreach ($roles as $role) {

            $arr[] = $role->name;
        }
        return $arr;
    }

    public function hasRole($roleNeed){
        $arr = array();
        $roles = $this->getRoles;
        foreach ($roles as $role) {

            $arr[] = $role->name;
        }

        return in_array($roleNeed,$arr);
    }

    public function worker()  {
        return $this->belongsTo(Worker::class, 'worker_id')->withDefault();
        
    }
}
