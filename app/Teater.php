<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teater extends Model
{
    protected $table = 'teater';
    protected $fillable = ['nama', 'kapasitas'];
    protected $primaryKey = 'id';
}