<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    protected $table = 'kursi';
    protected $fillable = ['nama', 'teater_id'];
    protected $primaryKey = 'id';

    public function teater()
    {
        return $this->belongsTo('App\Teater', 'teater_id');
    }
}