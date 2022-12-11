<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = ['hari', 'jam', 'harga', 'film_id', 'teater_id'];
    protected $primaryKey = 'id';

    public function film()
    {
        return $this->belongsTo('App\Film', 'film_id');
    }
    
    public function teater()
    {
        return $this->belongsTo('App\Teater', 'teater_id');
    }
}