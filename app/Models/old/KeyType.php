<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyType extends Model
{
    use HasFactory;
    protected $table = 'KeyType';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'];

}
