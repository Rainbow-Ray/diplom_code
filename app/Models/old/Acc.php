<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acc extends Model
{
    use HasFactory;
    protected $table = 'Acc';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'];

}
