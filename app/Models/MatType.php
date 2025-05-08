<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatType extends Model
{
    use HasFactory;
    protected $table = 'MatType';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'];

}
