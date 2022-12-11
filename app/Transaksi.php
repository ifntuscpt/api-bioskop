<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['jadwal_id', 'kursi_id', 'jumlah_dibayar', 'bukti_pembayaran', 'status'];
    protected $primaryKey = 'id';

    public function jadwal()
    {
        return $this->belongsTo('App\Jadwal', 'jadwal_id');
    }
    
    public function kursi()
    {
        return $this->belongsTo('App\Kursi', 'kursi_id');
    }
}