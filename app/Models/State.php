<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'State';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'state'
    ];
}
