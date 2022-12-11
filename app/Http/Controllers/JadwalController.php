<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use Exception;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllJadwal()
    {
        return response()->json(Jadwal::with('film')->with('teater')->get(), 200);
    }

    public function getDetailJadwal($id)
    {
        $jadwal = Jadwal::where('id', $id)->get();
        if (!$jadwal->isEmpty()) {
            return response()->json($jadwal, 200);
        } else {
            return response([
                'message' => 'Film tidak ditemukan'
            ], 404);
        }   
    }

    public function insertJadwal(Request $request)
    {
        try {
        $jadwal = new Jadwal;
        $jadwal->hari = $request->hari;
        $jadwal->jam = $request->jam;
        $jadwal->harga = $request->harga;
        $jadwal->film_id = $request->film_id;
        $jadwal->teater_id = $request->teater_id;
        $jadwal->save();
        
        return response([
            'statusAPI' => true,
            'message' => 'Jadwal berhasil ditambah'
        ], 200);
    } catch (Exception $e) {
        return response([
            'statusAPI' => false,
            'message' => 'Jadwal gagal ditambah'
        ], 404);
    }
}

    public function updateJadwal(Request $request, $id)
    {
        $detail_jadwal = Jadwal::where('id', $id)->first();

        if ($detail_jadwal) 
        {
            $jadwal = Jadwal::find($id);
            $jadwal->hari = $request->hari;$jadwal->jam = $request->jam;$jadwal->harga = $request->harga;$jadwal->film_id = $request->film_id;$jadwal->teater_id = $request->teater_id;
            $jadwal->save();
            return response([
                'statusAPI' => true,
                'message' => 'Jadwal berhasil diubah'
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Data Jadwal tidak ditemukan'
            ], 404);
        }
    }

    public function deleteJadwal(Request $request, $id)
    {
        $detail_jadwal = Jadwal::where('id', $id)->first();

        if ($detail_jadwal) 
        {
            $jadwal = Jadwal::destroy($id);
            if($jadwal)
            {
                return response([
                    'statusAPI' => true,
                    'message' => 'Jadwal berhasil dihapus'
                ], 200);
            }
        } else {
            return response([
                'statusAPI' => false,
                'message' => 'Data Jadwal tidak ditemukan'
            ], 404);
        }
    }
}