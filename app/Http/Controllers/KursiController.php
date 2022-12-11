<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursi;
use Exception;

class KursiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllKursi()
    {
        return response()->json(Kursi::with('teater')->all(), 200);
    }

    public function getDetailKursi($id)
    {
        $kursi = Kursi::where('id', $id)->get();
        if (!$kursi->isEmpty()) {
            return response()->json($kursi, 200);
        } else {
            return response([
                'message' => 'Film tidak ditemukan'
            ], 404);
        }   
    }

    public function insertKursi(Request $request)
    {
        try {
        $kursi = new Kursi;
        $kursi->nama = $request->nama;
        $kursi->teater_id = $request->teater_id;
        $kursi->save();
        return response([
            'statusAPI' => true,
            'message' => 'Kursi berhasil ditambah'
        ], 200);
    } catch (Exception $e) {
        return response([
            'statusAPI' => false,
            'message' => 'Kursi gagal ditambah'
        ], 404);
    }
}

    public function updateKursi(Request $request, $id)
    {
        $detail_kursi = Kursi::where('id', $id)->first();

        if ($detail_kursi) 
        {
            $kursi = Kursi::find($id);
            $kursi->nama = $request->nama;
            $kursi->teater_id = $request->teater_id;
            $kursi->save();
            return response([
                'statusAPI' => true,
                'message' => 'Kursi berhasil diubah'
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Data Kursi tidak ditemukan'
            ], 404);
        }
    }

    public function deleteKursi(Request $request, $id)
    {
        $detail_kursi = Kursi::where('id', $id)->first();

        if ($detail_kursi) 
        {
            $kursi = Kursi::destroy($id);
            if($kursi)
            {
                return response([
                    'statusAPI' => true,
                    'message' => 'Kursi berhasil dihapus'
                ], 200);
            }
        } else {
            return response([
                'statusAPI' => false,
                'message' => 'Data Kursi tidak ditemukan'
            ], 404);
        }
    }
}
