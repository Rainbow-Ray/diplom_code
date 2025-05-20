<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFurn extends Model
{
    use HasFactory;
    protected $table = 'CategoryFurn';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'];

}

